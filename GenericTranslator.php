<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";

class Translator implements Translate {

    static $queryStart = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

    static $queryEnd = "']/.."; 

    private $xml; 
   
    private function get_service(string $xml_fname, string $abbrev)
    {
       $simp = simplexml_load_file($xml_fname);

       $query = self::$queryStart . $abbrev . self::$queryEnd;

       $service = $simp->xpath($query);
 
       return $service[0];
    }


   public function __construct(string $fxml, string $service) 
   {
      /* 
        Use SimpleXML to retieve:
        - headers
        - query string parameters
       */ 
      $this->xml = $this->get_service($fxml, $service); 

      $this->headers = $this->get_headers($this->xml); 

      $this->query_string = $this->get_query($this->xml);

      $this->guzzle = new Guzzle(..$this->headers, ... $this->query_string);
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
