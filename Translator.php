<?php
declare(strict_types=1);
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

require 'vendor/autoload.php';

include "TranslateInterface.php";

class Translator implements TranslateInterface {

   private $route;      // $provider->services->service->translation->route;  
   private $method;     // $provider->services->service->translation->method; 
   private $query_str = array();

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

   // For derived class use, 
   protected function getCredentials(SimpleXMLElement $credentials) : string
   {
   }

   final protected function createClient(SimpleXMLElement $provider) : Client
   {
       //--$baseurl = (string) $provider->settings->baseurl;

       // Set credentials header and anything else like Content-Type, etc.
       $headers = array();

       if ((string)$provider->settings->credentials["method"] == "custom") 

               $headers = $this->getCredentials($provider->settings->credentials);

       else {
           
           foreach($provider->settings->credentials->header as $header) 
                
                $headers[(string) $provider->settings->credentials->header['name']] = (string) $header;
            
       }
       
       return  new Client([ 'base_uri' => (string) $this->provider->settings->baseurl, 'headers' => $headers]);        
   }

   final protected function getAPISettings(SimpleXMLElement $provider)
   {
      $this->route  = (string) $provider->services->translation->route;  
      $this->method = (string) $provider->services->translation->method;

      // todo: test
      $parms = array();
 
      foreach($provider->services->translation->query->parm as $parm) 

         $parms[ (string) $parm["name"] ] = urlencode( (string) $parm );


      $this->query_str = ['query' => $parms ];
   }  

   public function __construct(SimpleXMLElement $provider)
   {      
      $this->provider = $provider; // todo: Is this needed?
      
      $this->client = $this->createClient($provider); 

      $this->getAPISettings($provider);
   } 

   // Template pattern method that call protected method overriden by derived classes
   public function translate(string $text, string $source_lang, string $target_lang) 
   {
       /*
        * TODO: Do any remaining urlencode()'ing of any remaining query string parms.
        */

       $request = new Request($this->route, $this->method, $this->query_str);  

       $this->prepare_request($request, $text); // todo: prepare_text()?

       $this->client->send($request);
   }
   /*
    * Overriden by derived classes to do any special handling
    */
   //protected function create_request(object $request)
   protected function prepare_request(RequestInterface $requst, string $text)
   {
   }
}
