<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";

class Translator implements Translate {

    static $xquerys = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

    static $xquerye = "']/.."; 

    private $service; 

    private $endpoint; 

    private $request_method;

    private $headers = array(); // headers array that will be pass to guzzle client
    
    private $query_str = array(); // query string array that will be pass to guzzle client

    private $client; // Guzzle\Client
   
   static private function get_service(string $xml_fname, string $abbrev)
   {
      $simp = simplexml_load_file($xml_fname);
      
      $query = self::$xquerys . $abbrev . self::$xquerye;

      $service = $simp->xpath($query); // todo: return $simp->xpath($query)[0];  ??
 
      return $service[0];
   }
   /*
    * Overriden by derived classes to do any special handling
    */
   protected function prepare_request(object $request)
   {
       
   }
   
   // todo: This probably means "Translation" is an implementation class.
   static public function create(string $fxml, string $abbrev) 
   {
      $service = self::get_service($fsml, $abbrev);

      $trans = null;
  
      switch ($service->abbrev) {
        case "m":
           $trans = new MSTranslator($service); // or $this-impl = new MSTrans	 
           break;
        default:
          $trans = new Translator($service);
      } 

      return $trans;  
   }

   protected function __construct($service)
   {
      $this->service = $service; // ?
      
      foreach($service->headers->header as $header) 
          
      $this->headers[(string) $header->name] = (string) $header->value; 
   
      $this->baseurl = (string) $service->baseurl;
      
      $this->endpoint = (string) $service->endpoint;
      
      $this->request_method = (string) $service->request_method;
            
      foreach ($service->query_string as $qs)  
          
          $this->query_str[(string) $qs->name] = (string) $qs->value;
           

      $this->client = new Client(array('base_uri' => $this->base_url, 'headers' => $headers, 'query' => $query)); 
   }

   // Template method that call protected method overriden by derived classes
   public function translate(string $text, string $source_lang, string $target_lang) // TODO: Return what type of sentences object should be returned?
   {
       /*
         todo:
          1. Add $this->endpoint.
          2. Figure out how special pre-reqest end can be set in the Client. See design.md. See Guzzle prepare middleware and special "handler" facility.
        */
       $request = new Request();  

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
       $request = new Request(....);
       $requst->body???  
       return $obj; // generic response object or iterator?
   }
}
