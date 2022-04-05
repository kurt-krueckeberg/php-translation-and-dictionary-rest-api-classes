<?php
declare(strict_types=1);
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

require 'vendor/autoload.php';

include "TranslateInterface.php";

class Translator implements TranslateInterface {

   // These values are set by fetchAPISettings 
   private $route;           // $provider->services->service->translation->route;  
   private $method;          // $provider->services->service->translation->method; 
   private $query = array();
   private $headers = array();
   /* private $provider; This variable is define in __constructor's arument list. */
   
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
    * Factory method to create correct Translator class based on .xml <transaltor>SomeTranslatorClassHere</translator> value.
    */ 
   static public function createTranslator(string $fxml, string $abbrev) : Translator
   {
      $provider = self::get_provider($fxml, $abbrev); 
     
      $refl = new ReflectionClass((string) $provider->services->translation->implementation); 

      return $refl->newInstance($provider);
   }

   // override: For derived classes.
   protected function getCredentials(SimpleXMLElement $credentials) : string
   {
   }


   final protected function fetchAPISettings(SimpleXMLElement $provider)
   {
      if ((string)$provider->settings->credentials["method"] == "custom") 
      
           $this->headers = $this->getCredentials($provider->settings->credentials);
      
       else {
            
            foreach($provider->settings->credentials->header as $header) 
                 
                 $this->headers[(string) $provider->settings->credentials->header['name']] = (string) $header;
      }

      $this->route  = (string) $provider->services->translation->route;  
      $this->method = (string) $provider->services->translation->method;

      $parms = array();
 
      foreach($provider->services->translation->query->parm as $parm) 

           $parms[ (string) $parm["name"] ] = urlencode( (string) $parm );


      $this->query = $parms;
   }  

   public function __construct(protected SimpleXMLElement $provider) // PHP 8.0 feature: automatic member variable assignemnt syntax.
   {      
      //$this->provider = $provider; // todo: Is this needed?
      
       $this->client = new Client([ 'base_uri' => (string) $this->provider->settings->baseurl]);

      $this->fetchAPISettings($provider);
   } 

   // Template pattern method that call protected method overriden by derived classes
   public function translate(string $text)
   {
       /*
        * TODO: Do any remaining urlencode()'ing of any remaining query string parms.
        */

       // get the input text ready as either 'query' parameter or 'json' object.

       $options = ['query' => $this->query,
                   'headers' => $this->headers];
 
       if (true) // todo: Fix. Is input a query parameter or json text
          $input = $this->prepare_json_input($text);
       else  
           $input = "abc"; // = set ups query parameter that holds input text.

 
       $response = $this->client->request($this->method, $this->route, $options);
       //...
   }

   /*
    * Overriden by derived classes to do any special handling
    */
   //protected function create_request(object $request)
   protected function prepare_json_input(string $text) // todo: what type does json encode return?
   {
   }
}
