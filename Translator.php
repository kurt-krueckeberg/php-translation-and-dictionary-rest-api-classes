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

   static $provider_query =  "/providers/provider/name[@abbrev='%s']";  // "/providers/provider/name[normalize-space() = '"; // $movies->xpath('//character') as $character) 

   private $client; // Guzzle\Client
   
   static private function build_header(string $xml_fname, string $abbrev) // todo: These static methods in a trait?
   {
      /*
        build_header() // Example
        {
           // The array below is hardcoded. An actual implementaion should instead build the array from the credentials section of the xml.
           return ['Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",];
         ];                                                                                            
        } 
       */
       //todo: ibm requires token authorization.
   }

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
   static public function createTranslatorClass()
   {
      $refl = new ReflectionClass((string) $this->proivder->translator); //todo: Change $service-

      $trans = $refl->newInstance($service);

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

   public function __construct($service)
   {
      $this->provider = self::get_provier($service);

      $headers = self::build_header($this->provider);  
                                                                                                   
      $this->client = new Client([ 'base_uri' => (string) $this->provider->settings->baseurl, 'headers' => $headers]);  
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
