<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\ClassID;
use LanguageTools\ResultsIterator;
use LanguageTools\RestClient;

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
    
      if (count($obj->roms) == 0) 
          return null; 

      /*
         The [Pons documentation ](doc/pons-api.pdf) explains that each separate rom (Roamn numeral) correspondss to a part of speech:

           "For each part of speech there is one rom (roman numeral). For example "cut" may be a
            noun, adjective, interjection, transitive or intransitive verb and has the roms I to V."

          Each rom in turn has an array of arab's. Each arab stands for a specific meaning of the $rom->headword.

          Each arab contains a 'header' string and an array, 'translations', of \stdClass'es. For, say, the input word 'Abschied', the 1st
          rom's first arab:

            echo $obj->roms[0]->arabs[0]->header;
          
          is
              `1. Abschied <span class="sense">(Trennung)</span>`
          
          header can contain more spans with more information. The transations array holds \stdClasses with two strings: source and target.
          target is the English translation of the source. It can contain the 'sense', the 'headword' of an 'example'. This information is 
          in a <span>'s class, say: <span class="sense"> or <span class="example"> , etc.
       */
      
      foreach($obj->roms as $rom) { // rom == pos
          
           $result->headword = $rom->headword; // todo: rename $result->headword.
           $result->pos = $rom->wordclass; // Is the part of speech
           
           if (count($rom->arabs) == 0) continue;
        
            foreach ($rom->arabs as $arab) {
                
                if (count($arab->translations) == 0) // Sometimes there aren't definitions but something else.
                    continue;

                $definitions = array();

                       
                foreach($arab->translations as $translation) {
        
                      $definitions[] = $translation;//strip_tags($translation->target);
                 }

                 $result->definitions = $definitions;
            }
      }

      return $result; 
    }
}
