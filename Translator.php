<?php
declare(strict_types=1);
use GuzzleHttp\Client;

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

   /*
    * Overriden by derived classes to do any special handling
    */
   //protected function create_request(object $request)
   protected function prepare_request(object $request)
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
       /*
         todo:
          1. Include $this->endpoint to Request
 
          2. Figure out prepare_request() end can best be used. See the Request and PS-7 IMessage interface methods. 
             Would we, say, just use specical Handler class instead of derived-Translator classes?

          3. How does MySQL prepare_statement work?
        */
       $request = new Request($this->endpoint, );  

       $this->prepare_request($request); 

      /*
          todo:
              Add $this->endpoint to get request call.
              Add $this->method to get request call.
       */
       
       //++$this->client->send(); 

       /*
        * Use SimpleXMLElement to determine:
        *   - where the input text should be plaece--in requrst body, as a query string paramter, etc
        *   - do any associated processing like calulating the text's input length 
        */
       $obj = array(); 
      //...
      //++  $request = new Request(....);
      //++   $requst->body???  
      //
      //++  return an Array or TranslationObject/Translation object/stdClass tha has a common format between translators.
   }
}
