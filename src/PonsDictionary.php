<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/*
 Todo:

 Still Debugging this class

 Thoughts:

 The PONS json repsonse object layout:

   [lang] => 'de'
   [hits] => Array of stdClass objects
           [type]
           [opendict]
           [roms] => Array of stdClass objects 
                [headword] => 
                [headword_full] =>  
                [wordclass] => 
                [arabs] => Array of stdClass objects
                                [header] => 1. Handeln <span class="sense">(Feilschen)</span>:
                                [translations] => Array of stdClass objects
                                                [source] => <strong class="headword">Handeln</strong>
                                                [target] => haggling


Questions:
1. Does the response object itself always exist? Can it be null? Does its 'hits' property always exist. If so, can its count be zero?

if (count($obj->hits)) 
    continue;

foreach ($obj->hits as $hit_array) {

      if (count($hit_array->roms))
          continue;

      foreach($hit_array->roms as $rom_array) {

           if (count($rom_array->arabs))
               continue;
        
            foreach ($rom_array->arabs as $arab) {
        
                 foreach($arabs->translations as $translation) {
        
                      $results = strip_tags($translation);
                 }  
            }
       }
}

*/
class PonsDictionary extends  RestClient implements DictionaryInterface {

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

   public function __construct(\SimpleXMLElement $provider, string $abbrev)
   {   
       parent::__construct($provider, $abbrev);

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

       // debug
       $dbug = new \ArrayObject($obj);

       echo "Response for '$text' iterating response:\n\n";

       foreach ($dbug as $key => $value) {

             $v = (!is_array($value)) ?  strip_tags($value) : $value;

             echo $key . " = " . $v ."\nDoing print_r($v)\n";
             print_r($v); 
             echo "\n--------\n";
        }
       // debug end

       $results = array();
       
       /*
        * The PONS results as so tersely documented that one is not certain how to best parse 
        * and retreive the results.
        */

        if (count($obj->hits) == 0) 
            return $results;
        
        foreach ($obj->hits as $hit_array) {
        
              if (count($hit_array->roms) == 0)
                  continue;
        
              foreach($hit_array->roms as $rom_array) {
        
                   if (count($rom_array->arabs) == 0)
                       continue;
                
                    foreach ($rom_array->arabs as $arab) {
                
                         foreach($arabs->translations as $translation) {
                
                              $results = strip_tags($translation);
                         }  
                    }
               }
        }

       return $results;   
       //return ResultsIterator($results, )
   }
}
