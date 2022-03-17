<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";

class Translator implements Translate {

    static $xquerys = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

    static $xquerye = "']/.."; 

    private $endpoint; 
    
    private $client; // <-- new \Guzzle\Client
    
    private $request_method;

    private $headers = array();
    
    private $query_str = array();
   
   private function get_service(string $xml_fname, string $abbrev)
   {
      $simp = simplexml_load_file($xml_fname);
      
      $query = self::$xquerys . $abbrev . self::$xquerye;

      $service = $simp->xpath($query); // todo: return $simp->xpath($query)[0];  ??
 
      return $service[0];
   }

   protected function prepare_request()
   {
       
   }
   
   protected function send_request()
   {
       
   }
 
   public function __construct(string $fxml, string $service) 
   {
      $service = $this->get_service($fxml, $service); 
      
      $x = array();

      foreach($service->headers->header as $header) 
          
          $this->headers[(string) $header->name] = (string) $header->value; 
   
      $this->baseurl = (string) $service->baseurl;
      
      $this->endpoint = (string) $service->endpoint;
      
      $this->request_method = (string) $service->request_method;
            
      foreach ($service->query_string as $qs)  
          
          $this->query_str[(string) $qs->name] = (string) $qs->value;
           
      // $body = $this->get_body(...);  

     //++ $this->client = new Client(array('base_uri' => $this->base_url(), 'headers' => $headers, 'query' => $query); 
   }

   // Template method that call protected method overriden by derived classes
   public function translate(string $text, string $source_lang, string $target_lang) // TODO: Return what type of sentences object should be returned?
   {
      
       $this->prepare_request($text, $source_lang, $target_lang); // Derived classes do special handling here.
       
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
