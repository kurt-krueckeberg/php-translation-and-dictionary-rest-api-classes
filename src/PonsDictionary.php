<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class PonsDictionary implements DictionaryInterface {

   static string  $base_url = "https://api.pons.com/baseurl";
   static string  $method = "GET";
   static string  $route = "v1/dictionary";
   static string  $credential = "X-Secret";

   static string $xpath =  "/providers/provider[@abbrev='p']"; 

   public const SRC_LANG = 'in';
   public const DEST_LANG = 'language';
   public const DICTIONARY = 'l';
   public const INPUT = 'q';

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]
   private array $headers;
   private array $query;

   private Client $client;  

   public function __construct(\SimpleXMLElement $xml)
   {   

       $pons = $xml->xpath(self::$xpath)[0];

       $this->headers[self::$credential] = (string) $pons->settings->secret;

       $this->client = new Client(['base_uri' =>self::$base_url]); 
   } 

   public function lookup(string $text, string $src, string $dest) : array
   {
       $this->query[PonsDictionary::INPUT] = urlencode($text); 

       $this->query[PonsDictionary::SRC_LANG] = strtolower($src);   
       $this->query[PonsDictionary::DEST_LANG] = strtolower($dest); 

       $this->query[PonsDictionary::DICTIONARY] = strtolower($src . $dest);  

       $response = $this->client->request('GET', self::$route, ['query' => $this->query, 'headers' => $this->headers]);       

       $contents = $response->getBody()->getContents();
 
       // todo: Is urlecode needed?
       /*
       $arr = json_decode($contents, true)[0];
       
       echo count( $arr["hits"] ) . "\n";
       */
       $obj = json_decode($contents)[0];
       
       $results = array();
       
       /*
        * The PONS results as so tersely documented that one is not certain how to best parse 
        * and retreive the results.
        */
       foreach ($obj->hits as $element) { // Iteratoe over hits
            
           foreach($element->roms as $rom) { // Iterate over roms, then arabs 
           
             foreach($rom->arabs as $arab) {    
                 
                 foreach ($arab->translations as $translation) {
                     
                      $results[] = $translation->target;   
                      // print_r($translation); debug
               }
             }
          }
       }
       return $results;   
   }
}
