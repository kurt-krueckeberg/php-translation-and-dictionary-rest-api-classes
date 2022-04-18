<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class PonsDictionary extends  RestApi implements DictionaryInterface {

   static string  $base_url = "https://api.pons.com/baseurl";
   static string  $method = "GET";
   static string  $route = "v1/dictionary";
   static string  $credential = "X-Secret";

   static string $xpath =  "/providers/provider[@abbrev='p']"; 

   public const SRC_LANG = 'in';
   public const DEST_LANG = 'language';
   public const DICTIONARY = 'l';
   public const INPUT = 'q';

   private array $headers;
   private array $query;

   public function __construct(\SimpleXMLElement $provider)
   {   
       parent::__construct($provider);

       $this->headers[ (string) $provider->settings->credentials->header['name'] ] = (string) $provider->settings->credentials->header; 
   } 

   public function lookup(string $text, string $src, string $dest) : array
   {
       $this->query[PonsDictionary::INPUT] = urlencode($text); 

       $this->query[PonsDictionary::SRC_LANG] = strtolower($src);   
       $this->query[PonsDictionary::DEST_LANG] = strtolower($dest); 

       $this->query[PonsDictionary::DICTIONARY] = strtolower($src . $dest);  

       $contents = $this->request(self::$method, self::$route, ['headers' => $this->headers, 'query' => $this->query]); 

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
                     
                      $r = strip_tags($translation->target);   
                      $results[] = $r; 
               }
             }
          }
       }
       return $results;   
   }
}
