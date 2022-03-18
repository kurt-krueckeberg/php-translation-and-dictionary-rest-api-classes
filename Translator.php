<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";

/*
 *
 * TODO: Try to remove these class properties

   $query_string
   $headers

 *
 */
class Translator implements Translate {

    static $xqs = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

    static $xqe = "']/.."; 

    private $endpoint; 

    private $request_method;

    private $headers = array(); // headers array that will be pass to guzzle client
    
    private $query_str = array(); // query string array that will be pass to guzzle client

    private $client; // Guzzle\Client
   
   static private function get_service(string $xml_fname, string $abbrev)
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
      $service = self::get_service($fxml, $abbrev);

      $refl = new ReflectionClass((string) $service->translator);

      $trans = $refl->newInstance($service);

      return $trans;  
   }

   /*
    * Overriden by derived classes to do any special handling
    */
   protected function prepare_request(object $request)
   {
       
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
          
          $this->query_str[(string) $qs->name] = (string) $qs->value;
      }

      $this->client = new Client(array('base_uri' => (string) $service->baseurl, 'headers' => $this->headers, 'query' => $this->query_str)); 
   } 

   // Template method that call protected method overriden by derived classes
   public function translate(string $text, string $source_lang, string $target_lang) 
   {
       /*
         todo:
          1. Add $this->endpoint to Request
.
          2. Figure out prepare_request() end can best be used. See design.md. Is Guzzle prepare middleware and special "handler" facility relevant?
             Would we, say, just use specical Handler class instead of derived-Translator classes?
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
