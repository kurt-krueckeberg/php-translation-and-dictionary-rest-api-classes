<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\ClassID;
use LanguageTools\ResultsIterator;
use LanguageTools\RestClient;

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
   
Some of the returned 'translation' or definition objects are actually example sentence objects. To
detremine if  an object is an example, check its html <span class='example'> for the 'example' class.
 
*/
class PonsDictionary extends  RestClient {

   static array   $lookup   = array('method' => 'GET', 'route' => "dictionary");
   static array   $languages   = array('method' => 'GET', 'route' => "dictionaries");
   static string  $credential = "X-Secret";
   static string  $dictiony_language_parm = "language";


   public function __construct()
   {   
       parent::__construct(ClassID::Pons);
   } 

   final public function getDictionaryLanguages() : array 
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route']);
             
      $arr = json_decode($contents, true);
    
      return $arr;
   } 

   final public function getDictionaryForLanguages(string $lang) : array // todo: check the actual array to confirm it is what we want.
   {

      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['query' => ['language' => $lang ]]);
             
      $arr = json_decode($contents, true);
    
      return $arr;
   } 
   
   /*
    * Calling urlencode() for German words with umlauts or sharp s, results in no definition returned.
    * 
    */

   public function search(string $word, string $src, string $dest) : null | ResultsIterator
   {

       $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['query' => [ 'q' => $word, 'in'=> strtolower($src), 'language' => strtolower($dest), 'l' =>   strtolower($src . $dest)]  ]); 
       
       $results = array();
              
       if (empty($contents)) {
           
             echo "Response contenst for $word is empty.\n";
             return $results;
       }
       
       $obj = json_decode($contents)[0];

       print_r($obj);

       echo "\n--------------------\n";
       
      if (is_null($obj) || count($obj->hits) == 0) 
             return $results;

       return new ResultsIterator($obj->hits, PonsDictionary::get_result(...));
   }

   static private function get_result(mixed $obj) : \stdClass | null
   { 
      $result = new \stdClass;
      /* 
       * Emprically it appears all actual defnitions are in the first 'rom' and subsequent roms contain example phrses.
       * The problem is, there is no documentation explaining this.
       * The first hits' rom's arbas's header's being with an numeral, indicatingg the defnition number. They alkso have enbedded html.
       * 
       * Summarizing: The lack of documentation and the embedded html make the Pons API impractical to use.
       *  
       * * arabs are 'definitions' but a 'definition' can be simply an example phrase.       
       */
    
      if (count($hit->roms) == 0) 
          return null; 
      
      foreach($hit->roms as $rom) {
          
           $result->term = $rom->headword; // Is the term being defined
           $result->pos = rom->wordclass; // Is the part of speech
                   
           
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
      return $result; //new ResultsIterator($results, function($x) { return $x;});              
    }


}
