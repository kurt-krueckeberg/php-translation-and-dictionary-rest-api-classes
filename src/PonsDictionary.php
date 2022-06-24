<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{ClassID, ResultsIterator, RestClient}; 

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
   
   static private function get_result(mixed $obj) : PonsDictResult | null
   { 
      $result = new \stdClass;
      
      // type of dictionary entyr. Most often "entry". If not, then the result is a translation.
      $result->type = $obj->type;
      
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
          target is the English translation of the source. It can contain the 'sense', 'gramatical_constructions` 'headword' or an 'example'.
          This information is in a <span>'s class, say: <span class="sense"> or <span class="example"> , etc.

          These span classes are undocumented, however!
       */
      
      
      foreach($obj->roms as $rom) { 
          
           $result->headword = $rom->headword; 
           
           /* rom->headword_full Contains text with <span class='...'> that give:
            * 1. the part-of-speech, which is also in rom->wordclass
            * 2. the gender, if a noun.
            */
           $result->headword_full = $rom->headword_full; 
           
           if (isset($rom->wordclass))  {// not sure why this isn't always set.
               
               $result->pos = $rom->wordclass;    // Part-of-speech
           }
           
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
      new PonsDicResult($obj->type, 
      return $result; 
    }

   public function search(string $word, string $src, string $dest) : array | PonsDictResult
   {
       $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['query' => [ 'q' => $word, 'in'=> strtolower($src), 'language' => strtolower($dest), 'l' =>   strtolower($src . $dest)]  ]); 
       
       if (empty($contents)) {
           
             echo "Response contenst for $word is empty.\n";
             return array(); 
       }

       $obj = json_decode($contents)[0];
             
       if (is_null($obj) || count($obj->hits) == 0) 
             return null;
       /*
       $obj->type == dictionary 'entry' or 'translation'
        */
       return new ResultsIterator($obj->hits, PonsDictionary::get_result(...));
   }

   static private function get_result(mixed $element) : PonsDictResult | null
   { 
      $result = new \stdClass;
      
      // type of dictionary entyr. Most often "entry". If not, then the result is a translation.
      $result->type = $element->type;
      
      if (count($element->roms) == 0) 
          return null; 

      /*
         The [Pons documentation ](doc/pons-api.pdf) explains that each separate rom (Roamn numeral) correspondss to a part of speech:

           "For each part of speech there is one rom (roman numeral). For example "cut" may be a
            noun, adjective, interjection, transitive or intransitive verb and has the roms I to V."

          Each rom in turn has an array of arab's. Each arab stands for a specific meaning of the $rom->headword.

          Each arab contains a 'header' string and an array, 'translations', of \stdClass'es. For, say, the input word 'Abschied', the 1st
          rom's first arab:

            echo $element->roms[0]->arabs[0]->header;
          
          is
              `1. Abschied <span class="sense">(Trennung)</span>`
          
          header can contain more spans with more information. The transations array holds \stdClasses with two strings: source and target.
          target is the English translation of the source. It can contain the 'sense', 'gramatical_constructions` 'headword' or an 'example'.
          This information is in a <span>'s class, say: <span class="sense"> or <span class="example"> , etc.

          These span classes are undocumented, however!
       */
      
      foreach($element->roms as $rom) { 
          
           $result->headword = $rom->headword; 
           
           /* rom->headword_full Contains text with <span class='...'> that give:
            * 1. the part-of-speech, which is also in rom->wordclass
            * 2. the gender, if a noun.
            */
           $result->headword_full = $rom->headword_full; 
           
           if (isset($rom->wordclass))  {// not sure why this isn't always set.
               
               $result->pos = $rom->wordclass;    // Part-of-speech
           }
           
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
