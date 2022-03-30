<?php
declare(strict_types=1);
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

require 'vendor/autoload.php';

include "TranslateInterface.php";

/*
 *
 * TODO: urlencode of query string parameters.
 *
 *
 */
class Translator implements TranslateInterface {

   static string $provider_query =  "/providers/provider[@abbrev='%s']"; 

   private Client $client; // Guzzle\Client

   static private function get_provider(string $xml_fname, string $abbrev)
   {
      $simp = simplexml_load_file($xml_fname);

      $query = sprintf(self::$provider_query, $abbrev); 

      $response = $simp->xpath($query);

      return $response[0];
    }

   /*
    * Factory method to create correct Translator class based on .xml <transaltor>MyTranslator</translator> value.
    */ 
   static public function createTranslator(string $fxml, string $abbrev) : Translator
   {
      $provider = self::get_provider($fxml, $abbrev); 
      
      $refl = new ReflectionClass((string) $provider->services->translation->implementation); //todo: Change $service-

      $trans = $refl->newInstance($provider);

      return $trans;  
   }

  
   protected function createClient(SimpleXMLElement $provider) : Client
   {
       $headers = ""; // todo: 
       return  new Client([ 'base_uri' => (string) $this->provider->settings->baseurl, 'headers' => $headers]);        
   }

   public function __construct(SimpleXMLElement $provider)
   {      
      $this->provider = $provider; //--self::get_provider($service);
      
      $this->client = $this->createClient($provider); 
   } 

   // Template method that call protected method overriden by derived classes
   public function translate(string $text, string $source_lang, string $target_lang) 
   {
       $request = new Request($this->endpoint, GET/POST, $othersuff);  

       $this->prepare_request($request);

       $this->client->send($request);

       //...
   }
   /*
    * Overriden by derived classes to do any special handling
    */
   //protected function create_request(object $request)
   protected function prepare_request(RequestInterface $req)
   {
       
      /*
        Sample code
        todo: We supply the url "route" as the 2nd Request parameter
       */

       $query = ['query' => 
                    [ 'abc' => 'def']
                ]; 

       new Request("GET", $url, $query);
   }
   
}
