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
class PonsDictionary extends  RestClient {

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
       parent::__construct($c);
   } 

   final public function getDictionaryLanguages() : array 
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route']);
             
      $arr = json_decode($contents, true);
    
      return $arr;
   } 

   final public function getDictionaryForLanguages(string $lang) : array // todo: check the actual array to confirm it is what we want.
   {
      $this->query[self::$dictionary_lanauge_parm] = $lang; 

      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['query' => $this->query]);
             
      $arr = json_decode($contents, true);
    
      return $arr;
   } 
   
   /*
    * Calling urlencode() for German words with umlauts or sharp s, results in no definition returned.
    * 
    */

   public function search(string $word, string $src, string $dest) : array | ResultsIterator
   {
       $this->query[PonsDictionary::INPUT] = $word; // Note: Calling urlencode($word) results in an error for words with umlauts of sharp s.

       $this->query[PonsDictionary::SRC_LANG] = strtolower($src);   
       $this->query[PonsDictionary::DEST_LANG] = strtolower($dest); 

       $this->query[PonsDictionary::DICTIONARY] = strtolower($src . $dest);  

       $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['query' => $this->query]); 
       
       $results = array();
              
       if (empty($contents)) {
           
             echo "Response contenst for $word is empty.\n";
             return $results;
       }
       
       $obj = json_decode($contents)[0];

       print_r($obj);

       echo "\n--------------------\n";
       
      /*
       * todo: Create ResultsIterator($results, PonsDieciontary::get_result(...)); 
       */
      if (is_null($obj) || count($obj->hits) == 0) 
             return $results;
        
       foreach ($obj->hits as $hit) {
        
              if (count($hit->roms) == 0) 
                  continue;
              
              foreach($hit->roms as $rom) {
                  
                   $rom->headword // Is the term being defined
                   $rom->wordclass // Is the part of speech
                           
                   /* 
                    * Emprically it appears all actual defnitions are in the first 'rom' and subsequent roms contain example phrses.
                    * The problem is, there is no documentation explaining this.
                    * The first rom's arbas's header's being with an numeral, indicatingg the defnition number. They alkso have enbedded html.
                    * 
                    * Summarizing: The lack of documentation and the embedded html make the Pons API impractical to use.
                    *  
                    * * arabs are 'definitions' but a 'definition' can be simply an example phrase.       
                    */
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

       return $results; 
   }
}
