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
   private $input_queryparm;
   private $requires_jsonInput;
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
   static public function createFromXML(string $fxml, string $abbrev) : Translator
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

      $this->route  = (string) $provider->services->translation->route;  //todo: urlencode() ?? 
      $this->method = (string) $provider->services->translation->method;

      $parms = array();
 
      foreach($provider->services->translation->query->parm as $parm) 

           $parms[ (string) $parm["name"] ] = urlencode( (string) $parm );

      $this->query = $parms;

      if (isset($provider->services->translation->implementation['name'])) {

          $this->requires_jsonInput = true;
          $this->input_queryparm = $provider->services->translation->implementation['name'];
      }
   }  

   // TODO: Do I need to save $this->provider?
   public function __construct(protected SimpleXMLElement $provider) // PHP 8.0 feature: automatic member variable assignemnt syntax.
   {      
      //$this->provider = $provider; // todo: Is this needed?
      
       $this->client = new Client([ 'base_uri' => (string) $this->provider->settings->baseurl]);

      $this->fetchAPISettings($provider);
   } 

   // Template pattern method that call protected method overriden by derived classes
   final public function translate(string $text)
   {
       // get the input text ready as either 'query' parameter or 'json' object.

       if ($this->requires_jsonInput === true)  

          $request_input = ['query' => $this->query, 'headers' => $headers, 'json' => $this->prepare_json_input($text)]; 

       else { // input is a query string paramter whose name name is attribute of <implementation name="text">Translator</implementaion>

          $this->query[$this->input_queryparm] =  urlencode($text);

          $request_input = ['query' => $this->query, 'headers' => $this->headers]; 
       }

       $response = $this->client->request($this->method, $this->route, $request_input);

       // todo: call json_decode() and return a common format.
   }

   /*
    * Overriden by derived classes to do any special handling
    */
   //protected function create_request(object $request)
   protected function prepare_json_input(string $text) : string
   {
   }
}
