<?php
declare(strict_types=1);
namespace Translators;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

abstract class Translator implements TranslateInterface {

   private string $route;      
   private string $method;     
   private string $from_key;   // key for source language (optionsal)
   private string $to_key;     // key for destination language (required)

   private array $options;    

   /*  This is also a class member variable defined and set on the constructor's argument list (PHP >=8.0 required).
   private $provider;
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
    * Instantiates the Translator-derived class specified in <implementation>...</implementation>
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

   // PHP 8.0 feature: automatic member variable assignemnt syntax.
   public function __construct(protected \SimpleXMLElement $provider) 
   {      
       $this->provider = $provider;

       $options= $this->setConfigOptions($provider);

       $this->client = new Client(['base_uri' => (string) $this->provider->settings->baseurl]);
   } 

   private function setConfigOptions(\SimpleXMLElement $provider)
   {
      // Set the headers
      $headers = array();
      
      if ((string)$provider->settings->credentials["method"] == "custom") 
      
           $headers = $this->getCredentials($provider->settings->credentials);
      
      else {
            
          foreach($provider->settings->credentials->header as $header) 
          
               $headers[(string) $header['name']] = (string) $header;
      }

      $this->options['headers'] = $headers;

      $this->route  = (string) $provider->services->translation->route;  
      $this->method = (string) $provider->services->translation->method;

      $this->setQueryOptions($provider->services->translation->query);
   }  

   // Puts xml query settings in $this->options['query']
   private function setQueryOptions(\SimpleXMLElement $query)
   {
      $this->from_key = (string) $query->from['name'];
      $query_array = array();

       // set default source language, if present     
      if ($query->from !== '')

          $query_array[$this->from_key] = (string) $query->from;
      
      $this->to_key = (string) $query->to['name'];

      // set default destination language, if present
      if ($query->to !== '') 

            $query_array[$this->to_key] = (string) $query->to;

      // Set other default query string settings
      foreach($query->parm as $parm)  

          $query_array[ (string) $parm["name"] ] = urlencode( (string) $parm );

      $this->options['query'] = $query_array;
   }

   // Called by translate(string $text, string $dest_lang, $source_lang="")
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

   // Overriden by derived classes to add input text in the HTTP Message that Guzzle\Client will send.
   abstract protected function add_input(string $text);
    
   // Overriden by derived classes to return translated text as a string.
   abstract protected function process_response(Response $response) : string; 
   
   protected function setQueryParm(string $key, string $value)
   {
       $this->options['query'][$key] = $value;
   }

   // Helper method for use by derived classes, to set json input, if needed
   protected function setJson(array $json)
   {
       $this->options['json'] = $json;
   }
}
