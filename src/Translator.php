<?php
declare(strict_types=1);
namespace Translators;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

require 'vendor/autoload.php';

abstract class Translator implements TranslateInterface {

   // These values are set in fetchAPISettings() 
   private $route;           // $provider->services->service->translation->route;  
   private $method;          // $provider->services->service->translation->method; 
   private $query = array();
   private $headers = array();
   private $isJsonInput;  // boolean
   private $inputKeyName; // This will only be set if the '<input..' node has a parm attibute,
                          // for example: <input parm="text">query</input>

   /* 
   private $provider; // <-- Also a class member variable. 
   Note: $provider is also defined and set on the constructor's argument list, using PHP 8.0 new feature that allows this. 
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
    * Method clients will call to create the Translator-derived class specified in the config.xml in <implementation>...</implementation>
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

   final protected function fetchAPISettings(\SimpleXMLElement $provider)
   {
      if ((string)$provider->settings->credentials["method"] == "custom") 
      
           $this->headers = $this->getCredentials($provider->settings->credentials);
      
      else {
            
          foreach($provider->settings->credentials->header as $header) 
          
               $this->headers[(string) $header['name']] = (string) $header;
          
      }

      //todo: Should route and method be urlencode()'ed?
      $this->route  = (string) $provider->services->translation->route;  
      $this->method = (string) $provider->services->translation->method;

      $this->isJsonInput = ('json' == (string) $provider->services->translation->input) ?  true : false;

      if (isset($provider->services->translation->input['parm']))
          $this->inputKeyName = (string) $provider->services->translation->input['parm'];

      foreach($provider->services->translation->query->parm as $parm) 

          $this->query[ (string) $parm["name"] ] = urlencode( (string) $parm );
   }  

   //public function __construct(protected \SimpleXMLElement $provider) // PHP 8.0 feature: automatic member variable assignemnt syntax.
   public function __construct(protected \SimpleXMLElement $provider) // PHP 8.0 feature: automatic member variable assignemnt syntax.
   {      
       $this->provider = $provider;
       $this->client = new Client([ 'base_uri' => (string) $this->provider->settings->baseurl]);

       $this->fetchAPISettings($provider);
   } 

   /* 'Template pattern' method that calls abstract protected methods overriden by derived classes (to prepare the input amd
       to extract the translated text (as a string) from he reponse. */
   final public function translate(string $text)
   {
       // get the input text ready as either 'query' parameter or 'json' object.
       $input = $this->prepare_input($text); 

       var_dump(json_encode($input), true); 

       if ($this->isJsonInput) {  // If array holds json encoded body entity. 

          //--$response = $this->client->request($this->method, $this->route, ['query' => $this->query, 'headers' => $this->headers, 'json' => [$input]]);
          $response = $this->client->request($this->method, $this->route, ['query' => $this->query, 'headers' => $this->headers, 'json' => $input]);

       } else { // input is a query string paramter whose name name is attribute of <implementation name="text">Translator</implementaion>
          
          $this->query[$this->inputKeyName] = $input;

          $request_input = ['query' => $this->query, 'headers' => $this->headers]; 
       }

       //++$response = $this->client->request($this->method, $this->route, $request_input);
       
       return $this->process_response($response);
   }

   // Overriden by derived classes to prepare input text in HTTP Message that Guzzle\Client will send.
   abstract protected function prepare_input(string $text) : array|string;
    
   // Overriden by derived classes to return translated text as a string.
   abstract protected function process_response(Response $response) : string; 
}
