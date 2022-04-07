<?php
declare(strict_types=1);
namespace Translators;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

// todo: Move comments to readme that has links to the doc folder
abstract class Translator implements TranslateInterface {

   // These values are set in fetchAPISettings() 
   private $route;           // $provider->services->service->translation->route;  
   private $method;          // $provider->services->service->translation->method; 
   private $query_str = array();
   private $from_key;       // key for source language (optionsal)
   private $to_key;         //  key for destination language (required)
   private $headers = array();
   private $bJsonInput;    // boolean indicates if json input (rather thna a query string parameter) is required by the API.
   private $inputKeyName; // This will only be set if, '<input parm="text">..' node has the parm attibute,

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
       $this->client = new Client([ 'base_uri' => (string) $this->provider->settings->baseurl]);

       $this->fetchAPISettings($provider);
   } 

   final protected function fetchAPISettings(\SimpleXMLElement $provider)
   {
      if ((string)$provider->settings->credentials["method"] == "custom") 
      
           $this->headers = $this->getCredentials($provider->settings->credentials);
      
      else {
            
          foreach($provider->settings->credentials->header as $header) 
          
               $this->headers[(string) $header['name']] = (string) $header;
      }

      $this->route  = (string) $provider->services->translation->route;  
      $this->method = (string) $provider->services->translation->method;

      $this->bJsonInput = ('json' == (string) $provider->services->translation->input) ? true : false;

      if (isset($provider->services->translation->input['parm']))
          $this->inputKeyName = (string) $provider->services->translation->input['parm'];

      $this->fetchQuerySection($provider->services->translation->query);
   }  

   protected function fetchQuerySection(\SimpleXMLElement $query)
   {
      $this->from_key = (string) $query->from['name'];

      if ($query->from !== '')

          $this->query_str[$this->from_key] = (string) $query->from;
      
      $this->to_key = (string) $query->to['name'];

      if ($query->to !== '')

            $this->query_str[$this->to_key] = (string) $query->to;

      foreach($query->parm as $parm)  // These are required parameters with default values

          $this->query_str[ (string) $parm["name"] ] = urlencode( (string) $parm );
   }

   final protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "")
            $this->query_str[$this->from_key] = $source_lang; 

      $this->query_str[$this->to_key] = $dest_lang; 
   }

   /* 'Template pattern' method that calls abstract protected methods overriden by derived classes (to prepare the input amd
       to extract the translated text (as a string) from he reponse. */
   final public function translate(string $text, string $dest_lang, $source_lang="")
   {
       $this->setLanguages($dest_lang, $source_lang);

       $input = $this->prepare_input($text); 

       if ($this->bJsonInput) {  // If array holds json encoded body entity. 

          $options = ['query' => $this->query_str, 'headers' => $this->headers, 'json' => $input];

       } else { 
          
          $this->query_str[$this->inputKeyName] = $input;

          $options = ['query' => $this->query_str, 'headers' => $this->headers];
       }

       $response = $this->client->request($this->method, $this->route, $options); 

       return $this->process_response($response);
   }

   // Overriden by derived classes to prepare input text in HTTP Message that Guzzle\Client will send.
   protected function prepare_input(string $text) : array|string
   {
      return urlencode($text);
   } 
    
   // Overriden by derived classes to return translated text as a string.
   abstract protected function process_response(Response $response) : string; 
}
