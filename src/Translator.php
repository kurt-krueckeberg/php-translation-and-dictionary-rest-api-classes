<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

abstract class Translator implements TranslateInterface {

   private string $route;      
   private string $method;     // GET, POST, etc 
   private string $from_key;   // key for source language (which is optional)
   private string $to_key;     // key for destination language (required)

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]

   // private $provider; is defined and set on the constructor's argument list (PHP >=8.0 required).
   
   private Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   // Instantiates the Translator-derived class specified in <implementation>...</implementation>
   static public function createFromXML(\SimpleXMLElement $xml, string $abbrev) : Translator
   {
      $query = sprintf(self::$xpath, $abbrev); 
     
      $provider = $xml->xpath($query)[0];
     
      $refl = new \ReflectionClass((string) $provider->settings->implementation); 
      
      return $refl->newInstance($provider);
   }
   
   // PHP 8.0 feature required: automatic member variable assignemnt syntax.
   public function __construct(protected \SimpleXMLElement $provider) 
   {      
       $this->provider = $provider;

       $this->setConfigOptions($provider);

       $this->client = new Client(['base_uri' => (string) $this->provider->settings->baseurl]);
   } 

   private function setConfigOptions(\SimpleXMLElement $provider)
   {
      $headers = array();
      
      if ((string)$provider->settings->credentials["method"] == "custom") 
      
           $headers = $this->getCredentials($provider->settings->credentials);
      
      else {
            
          foreach($provider->settings->credentials->header as $header) 
          
               $headers[(string) $header['name']] = (string) $header;
      }

      $this->options['headers'] = $headers;

      $trans = $provider->xpath("requests/request[@type='translation']")[0];

      $this->route  = (string) $trans->route;  
      $this->method = (string) $trans->method; 

      $this->setQueryOptions($provider->settings->query);
   }  

   // Assign xml <query> section settings 
   private function setQueryOptions(\SimpleXMLElement $query)
   {
      $query_array = array();

      $this->from_key = (string) $query->from['name'];

      $this->to_key = (string) $query->to['name'];

      foreach($query->parm as $parm)  
              $query_array[ (string) $parm["name"] ] = urlencode( (string) $parm );

      $this->options['query'] = $query_array;
   }

   // If this is a translation request and there is no source language, the source langauge will be auto-detected.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->options['query'][$this->from_key] = $source_lang; 

      $this->options['query'][$this->to_key] = $dest_lang; 
   }

   /*
     Template-pattern method that calls abstract protected methods overriden by derived classes (to prepare the input amd
       to extract the translated text and return a translated string from he reponse). 
    */
   final public function translate(string $text, string $dest_lang, $source_lang="")
   {
       $this->setLanguages($dest_lang, $source_lang);

       $this->add_text($text); // Implemented by derived classes.

       $response = $this->client->request($this->method, $this->route, $this->options); 

       return $this->extract_translation($response);
   }

   // Overriden by derived classes to add input text to the HTTP Message that Guzzle\Client will send.
   // IT will be added either as a query strng parameter or JSON set in the body of the message by Guzzle\Client.
   abstract protected function add_text(string $text);
    
   // Overriden by derived classes to return translated text as a string.
   abstract protected function extract_translation(Response $response) : string; 
   
   protected function setQueryParm(string $key, string $value)
   {
       $this->options['query'][$key] = $value;
   }

   // Helper method for use by derived classes, to set json input, if needed
   protected function setJson(array $json)
   {
       $this->options['json'] = $json;
   }

   // Calls Guzzle Client post method, mainly intended for AzureTranslator. in addtion to tranlate, it can do
   // diictionary lookups and get example sentences, etc.
   protected function post(string $route)
   {
        return $this->client->request('POST', $route, $this->options);
   }

   // Calls Guzzle Client get method, mainly intended for AzureTranslator. in addtion to tranlate, it can do
   // diictionary lookups and get example sentences, etc.
   protected function get(string $route)
   {
        return $this->client->request('POST', $route, $this->options);
   }

}
