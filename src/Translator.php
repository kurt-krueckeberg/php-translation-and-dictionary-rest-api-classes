<?php
declare(strict_types=1);
namespace Translators;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

abstract class Translator implements TranslateInterface {

   /*
   todo: Replace $query and $haders $options array with 'headers' and 'query' keys.
    */
    
   // These values are set in fetchAPISettings() 
   private string $route;           // $provider->services->service->translation->route;  
   private string $method;          // $provider->services->service->translation->method; 
   private string $from_key;       // key for source language (optionsal)
   private string $to_key;         //  key for destination language (required)

   private array $options;  // todo: Add the xml settings -- header and query -- to $options in the constructor.

   /* 
   private $provider; // <-- This is also a class member variable defined and set on the constructor's argument list (PHP >=8.0 required).
    */
   
   private Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   static private function get_provider(string $xml_name, string $abbrev)
   {
      $simp = simplexml_load_file($xml_name);
     
      $query = sprintf(self::$xpath, $abbrev); 
     
      $response = $simp->xpath($query);
     
      return $response[0];
   }

   /*
    * Method clients call to instantiate the Translator-derived class specified in the config.xml in <implementation>...</implementation>
    */ 
   static public function createFromXML(string $fxml, string $abbrev) : Translator
   {
      $provider = self::get_provider($fxml, $abbrev); 
      
      $refl = new \ReflectionClass((string) $provider->services->translation->implementation); 
      
      return $refl->newInstance($provider);
   }

   protected function getCredentials(\SimpleXMLElement $credentials) : string
   {
   }

   public function __construct(protected \SimpleXMLElement $provider) // PHP 8.0 feature: automatic member variable assignemnt syntax.
   {      
       $this->provider = $provider;

       $options= $this->setConfigOptions($provider);

       $this->client = new Client(['base_uri' => (string) $this->provider->settings->baseurl]);
   } 

   private function setConfigOptions(\SimpleXMLElement $provider)
   {
      // set the headers
      $headers = array();
      
      if ((string)$provider->settings->credentials["method"] == "custom") 
      
           $headers = $this->getCredentials($provider->settings->credentials);
      
      else {
            
          foreach($provider->settings->credentials->header as $header) 
          
               $headers[(string) $header['name']] = (string) $header;
      }

      $this->options['headers'] = $headers;

      $this->route  = (string) $provider->services->translation->route;   // passed on ->request($this->method, $this->route, $this->options)
      $this->method = (string) $provider->services->translation->method;

      $this->setQueryOptions($provider->services->translation->query);
   }  

   private function setQueryOptions(\SimpleXMLElement $query)
   {
      $this->from_key = (string) $query->from['name'];
      $query_array = array();
      
      if ($query->from !== '')// set default source language, if present

          $query_array[$this->from_key] = (string) $query->from;
      
      $this->to_key = (string) $query->to['name'];

      // set query options
      if ($query->to !== '') // set default destination language, if present

            $query_array[$this->to_key] = (string) $query->to;

      foreach($query->parm as $parm)  // These are required parameters with default values that are fixed.

          $query_array[ (string) $parm["name"] ] = urlencode( (string) $parm );

      $this->options['query'] = $query_array;
   }

   private function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "")
           $this->options['query'][$this->from_key] = $source_lang; 

      $this->options['query'][$this->to_key] = $dest_lang; 
   }

   /* 'Template pattern' method that calls abstract protected methods overriden by derived classes (to prepare the input amd
       to extract the translated text (as a string) from he reponse. */
   final public function translate(string $text, string $dest_lang, $source_lang="")
   {
       $this->setLanguages($dest_lang, $source_lang);

       $this->add_input($text); 

       $response = $this->client->request($this->method, $this->route, $this->options); 

       return $this->process_response($response);
   }

   // Overriden by derived classes to add input text in HTTP Message that Guzzle\Client will send.
   abstract protected function add_input(string $text);
    
   // Overriden by derived classes to return translated text as a string.
   abstract protected function process_response(Response $response) : string; 
   
   protected function setQueryParm(string $key, string $value)
   {
       $this->options['query'][$key] = $value;
   }

   protected function setJson(array $json)
   {
       $this->options['json'] = $json;
   }
}
