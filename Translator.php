<?php
declare(strict_types=1);
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

require 'vendor/autoload.php';

include "TranslateInterface.php";

class Translator implements TranslateInterface {

   private $route;    
   private $method;   
   private $from_name;
   private $to_name;  

   private Client $client; 

   static string $provider_query =  "/providers/provider[@abbrev='%s']"; 

   static private function get_provider(string $xml_name, string $abbrev)
   {
      $simp = simplexml_load_file($xml_name);
     
      $query = sprintf(self::$provider_query, $abbrev); 
     
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
       $headers = ""; // todo: Add whatever is neede to extract xml settings and create Guzzle\Client

       $baseurl = $provider->settings->credentials->baseurl;

        // Build Credentials header
       $headers = array();

       if ((string)$provider->settings->credentials["method"] == "custom") 

               $headers = $this->getCredentials($provider->settings->credentials);

       else
            foreach($provider->settings->credentials->header as $header) 

               $headers['name'] = (string) $header;
       
       return  new Client([ 'base_uri' => (string) $this->provider->settings->baseurl, 'headers' => $headers]);        
   }

   final protected function getTranslationSettings()
   {
       $this->route     = (string) $provider->services->service->translation->route; 
       $this->method    = (string) $provider->services->service->translation->request_method;
       $this->from_name = (string) $provider->services->service->translation->from;
       $this->to_name   = (string) $provider->services->service->translation->to;
   }  

   public function __construct(SimpleXMLElement $provider)
   {      
      $this->provider = $provider; 
      
      $this->client = $this->createClient($provider); 

      $this->getTranslationSettings();
   } 

   // Template method that call protected method overriden by derived classes
   public function translate(string $text, string $source_lang, string $target_lang) 
   {
       $request = new Request($this->endpoint, $this->method, $othersuff);  

     /*
      * TODO: Add urlencode() of query each string parameter.
      */
     
       $this->prepare_request($request);

       $this->client->send($request);
   }
   /*
    * Overriden by derived classes to do any special handling
    */
   //protected function create_request(object $request)
   protected function prepare_request(RequestInterface $req)
   {

   }
}
