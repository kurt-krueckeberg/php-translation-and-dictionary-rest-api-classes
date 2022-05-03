<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/*
  PONS json repsonse object layout:

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
   
Some of the returned 'translation' or definition objects are actually example sentence objects. There
only way to know if such a 'translation' object is an example is to check if the html <span> tag has a 
class of type: class='example'>.
 
Question: How should such examples be returned along with the other results?
*/
class PonsDictionary extends  RestClient implements DictionaryInterface {

   static string  $method   = "GET";
   static array   $lookup   = array('method' => 'GET', 'route' => "v1/dictionary");
   static array   $languages   = array('method' => 'GET', 'route' => "v1/dictionaries");
   static string  $credential = "X-Secret";
   static string  $dictiony_language_parm = "language";

   static string $xpath =  "/providers/provider[@abbrev='p']"; 

   public const SRC_LANG = 'in';
   public const DEST_LANG = 'language';
   public const DICTIONARY = 'l';
   public const INPUT = 'q';

   private array $headers;
   private array $query;

   public function __construct(PonsConfig $c = new PonsConfig)
   {   
       parent::__construct($c->endpoint);

       $this->headers[array_key_first($c->header)] = $c->header[array_key_first($c->header)];
   } 

   final public function getDictionaryLanguages() : array // todo: check the actual array to confirm it is what we want.
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers]);
             
      $arr = json_decode($contents, true);
    
      return $arr;
   } 

   final public function getDictionaryForLanguages(string $lang) : array // todo: check the actual array to confirm it is what we want.
   {
      /* 
        todo: Implement in a base Dictionary class or -- better yet--DictionaryTrait -- the method `valid_iso_code($lang)` to confirm that the language is a valid ISO two-letter language code:

      if (strlen($lang) !== 2 || !valid_iso_code($lang))
           throw new \Exception("$lang is not a valid ISO two-leeter language code."); 
     
       */
      $this->query[self::$dictionary_lanauge_parm] = $lang; 

      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      $arr = json_decode($contents, true);
    
      return $arr;
   } 
   
   /*
    * Calling urlencode() for German words with umlauts or sharp s, results in no definition returned.
    * 
    */

   public function lookup(string $word, string $src, string $dest) : array | ResultsIterator
   {
       $this->query[PonsDictionary::INPUT] = $word; // Note: Calling urlencode($word) results in an error for words with umlauts of sharp s.

       $this->query[PonsDictionary::SRC_LANG] = strtolower($src);   
       $this->query[PonsDictionary::DEST_LANG] = strtolower($dest); 

       $this->query[PonsDictionary::DICTIONARY] = strtolower($src . $dest);  

       $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['headers' => $this->headers, 'query' => $this->query]); 
       
       $results = array();
              
       if (empty($contents)) {
           
             echo "Response contenst for $word is empty.\n";
             return $results;
       }
       
       $obj = json_decode($contents)[0];

       print_r($obj);

       echo "\n--------------------\n";
       
       /*
        * todo: Create PonsResultsIterator and put the logic below into its `get_current($current)`
        * method. And return a PonsResultsIterator 
        * 
        */
        if (is_null($obj) || count($obj->hits) == 0) 
             return $results;
        
       $has_entries = $obj->hits[0]->type == "entry" ? true : false;   
            
        foreach ($obj->hits as $hit) {
        
              if (count($hit->roms) == 0) 
                  continue;
              
              foreach($hit->roms as $rom) {
        
                   if (count($rom->arabs) == 0)
                       continue;
                
                    foreach ($rom->arabs as $arab) {
                        
                        if (count($arab->translations) == 0)
                           continue;
                
                        foreach($arab->translations as $translation) {
                
                              $results[] = $translation;//strip_tags($translation->target);
                         }  
                    }
               }
        }

       //--return $results;   
       return $results; //new ResultsIterator($results, function($x) { return $x;});              
   }
}
