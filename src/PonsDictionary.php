<?php
declare(strict_types=1);
namespace LanguageTools;

//use LanguageTools\{ClassID, ResultsIterator, RestClient, PonsIterator}; 

class PonsDictionary extends  RestClient implements DictionaryInterface {

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

   public function lookup(string $word, string $src, string $dest) : PonsIterator | null
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
       return  new PonsIterator($obj->hits);
   }
}
