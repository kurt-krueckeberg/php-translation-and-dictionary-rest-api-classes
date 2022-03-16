<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";

class Translator implements Translate {

    static $querys = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

    static $querye = "']/.."; 

    private $xml; 
    private $client;
   
    private function get_service(string $xml_fname, string $abbrev)
    {
       $simp = simplexml_load_file($xml_fname);

       $query = self::$quers . $abbrev . self::$querye;

       $service = $simp->xpath($query);
 
       return $service[0];
    }


   public function __construct(string $fxml, string $service) 
   {
      //todo: read up on SimpleXMLElement
       
      $this->xml = $this->get_service($fxml, $service); 

      $headers = $this->xml->headers; 

      $this->xml->baseurl;
      $this->xml->endpoint;
      $this->xml->request_method;
      $this->xml->query_string;
           
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
