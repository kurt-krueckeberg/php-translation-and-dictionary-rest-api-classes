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

    // $xqs = XPath query 'start'
    static $xqs = "/providers/provider/nametranslation_services/service/abbrev[normalize-space() = '";

    static $xqe = "']/.."; // $xqe = XPath query 'end'

    private $endpoint; 

    private $request_method;

    private $headers = array(); // headers array that will be pass to guzzle client
    
    private $query_str = array(); // query string array that will be pass to guzzle client

    private $client; // Guzzle\Client
   
   static private function get_provider(string $xml_fname, string $abbrev)
   {
      $simp = simplexml_load_file($xml_fname);
      
      $query = self::$xqs . $abbrev . self::$xqe;

      $service = $simp->xpath($query); 
 
      if ($service === null || $service === false)
          throw new ErrorException("Translation service not found in $xml_fname.\n");
  
      return $service[0];

   static private function get_settings(string $xml_fname, string $abbrev)
   {

      $simp = simplexml_load_file($xml_fname);
      
      $query = self::$xqs . $abbrev . self::$xqe;

      $service = $simp->xpath($query); 
 
      if ($service === null || $service === false)
          throw new ErrorException("Translation service not found in $xml_fname.\n");
  
      return $service[0];
   }

   /*
    * Factory method to create correct Translator class based on .xml <transaltor>MyTranslator</translator> value.
    */ 
   static public function create(string $fxml, string $abbrev) 
   {

      /*
         todo: 
           Q: Should I change this get_credentials() or get_settings()/get_general_settings() or get_client_settings/prepare_client() or
              get_client_settings()?
           Q: Should I call this method after creating the Guzzel\Client() 

       */   
      $service = self::get_settings($fxml, $abbrev);

      $refl = new ReflectionClass((string) $service->translator{); //todo: Change $service-

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
      $service = $service; 
      
      foreach($service->headers->header as $header) { 

            $this->headers[(string) $header->name] = (string) $header->value; 
      }
   
      $this->endpoint = (string) $service->endpoint;
      
      $request_method = (string) $service->request_method;
            
      foreach ($service->query_string as $qs) {

         //todo: urlencode of certain query string parameters.
          
          $this->query_str[(string) $qs->name] = (string) $qs->value;
      }

      $this->client = new Client(array('base_uri' => (string) $service->baseurl, 'headers' => $this->headers, 'query' => $this->query_str)); 
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
