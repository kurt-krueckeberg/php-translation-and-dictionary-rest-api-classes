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
   
   public function get_german_noun_gender(string $word) : string
   {       
       $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['query' => [ 'q' => $word, 'in'=> strtolower('de'), 'language' => strtolower('en'), 'l' =>   'deen']  ]); 
       
       if (empty($contents)) {
           
             echo "Response contenst for $word is empty.\n";
             return null; 
       }

       $obj = json_decode($contents)[0];

       foreach ($obj->hits as $hit) {

         foreach ($hit->roms as $rom)  {
             
          //  $x = strip_Tags($rom->headword); // and we must remove the spearator
          // $x = trim($x, "" )
          
          //if ($x == $word && isset($rom->wordclass)) {
          if (isset($rom->wordclass) && $rom->wordclass == "noun") {

                  $hwf = "<p>" . $rom->headword_full . "</p>";
                  break;
         } 
       }
       // XPath query is: "//span[@class="genus"]/acronym[@title]
       // todo: query a domdocument as in DlHtmlBuilder::get_gender()
       // 
       // $this-query($hwf);
       /*
       $rc = preg_match('@<acronym title="([^"]+)">([a-z])</acronym>@', $hwf, $matches);
      
      if ($rc === false)
          return '';
      
      return $matches[1];
        * 
        */
    }

   }
   public function search(string $word, string $src, string $dest) : array | ResultsIterator
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

   static private function get_result(mixed $obj) : \stdClass | null
   { 
      $result = new \stdClass;
      
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
           
           /* rom->headword_full Contains span classes that tell us:
            * 1. the part-of-speech, which is also in rom->wordclass
            * 2. the gender
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
