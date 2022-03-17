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
       
       //Test::$xquery

       $query = self::$xquerys . $abbrev . self::$xquerye;

       $service = $simp->xpath($query); // todo: return $simp->xpath($query)[0];  ??
 
       return $service[0];
    }


   public function __construct(string $fxml, string $service) 
   {
      $service = $this->get_service($fxml, $service); 

      foreach($service->headers->header as $header) 
          $this->headers[$header->name] = $header->value; 
   
      $this->baseurl = $this->service->baseurl;
      
      $this->endpoint = $xml->service->endpoint;
      
      $this->request_method = $this->service->request_method;
      
      foreach ($this->service->query_string as $qs)  $this->query_str[$qs->name] = $qs->value;
           
      // $body = $this->get_body(...);  

     //++ $this->client = new Client(array('base_uri' => $this->base_url(), 'headers' => $headers, 'query' => $query); 
   }

   public function translate(string $text, string $source_lang, string $target_lang) // TODO: Return what type of sentences object should be returned?
   {
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
