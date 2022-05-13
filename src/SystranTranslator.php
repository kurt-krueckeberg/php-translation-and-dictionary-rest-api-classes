<?php
declare(strict_types=1);
namespace LanguageTools;

// Under development
class SystranTranslator extends RestClient implements TranslateInterface, DictionaryInterface {

   static private array  $trans = array('method' => "POST", 'route' => "translation/text/translate");

   static private array  $dict_languages = array('method' => "GET", 'route' => "resources/dictionary/supportedLanguages");

   static private array  $trans_languages = array('method' => "GET", 'route' => "translation/supportedLanguages");

   static private array  $lookup  = array('method' => "GET", 'route' => "resources/dictionary/lookup");

   static private $input = 'input'; 
   static private string $from = "source";
   static private string $to = "target";

   private array $headers = array();
   private array $query = array(); 

   /*
    The Systranr 'option' query paramter can occur more than one. NOt sure how to specify this for Guzzle:
    I guess that would mean $thi->query['option'] = ['aaa', 'bbb', ... ];?
    */
   
   public function __construct(ClassID $id)
   {
       parent::__construct($id); // "https://api-translate.systran.net", array('Authorization' => 'Key bf31a6fd-f202-4eef-bc0e-1236f7e33be4')); 
   }

   public function getTranslationLanguages() : array
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['query' => $this->query]);
             
      $arr = json_decode($contents, true);
    
      return $arr["translation"]; 
    } 

   final public function getDictionaryLanguages() : array
   {
      $contents = $this->request(self::$dict_languages['method'], self::$dict_languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      return json_decode($contents, true);    
   } 

  // If there is no source language, the source langauge will be auto-detected.
  // The default expected encoding is utf-8. If it is not utf-8, use the 'options' paramter to specify the endocing.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from] = $source_lang; 

      $this->query[self::$to] = $dest_lang; 
   }

   /*
    *  Systran requires the language codes to be lowercase.
    *  If the language is not utf-8, then you must speciy the encoding using the 'options' parameter.
    */
   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages(strtolower($dest_lang), strtolower($source_lang)); 

       $this->query[self::$input] = $text;// urlencode($text);  

       $contents = $this->request(self::$trans['method'], self::$trans['route'], ['headers' => $this->headers, 'query' => $this->query]); 

       $obj = json_decode($contents);

      /*
       * The layout of the results is documented at https://docs.systran.net/translateAPI/translation/#tag-Translation
       */
       return urldecode($obj->outputs[0]->output);
   }

   /*
    * The layout of the results json object is described in /doc/dict-output-systrans.txt
    */
   final public function lookup(string $word, string $src_lang, string $dest_lang) : ResultsIterator
   {      
      $this->setLanguages(strtolower($dest_lang), strtolower($src_lang)); 
       
      $this->query[self::$input] = $word;// urlencode($text);  

      $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['headers' => $this->headers, 'query' => $this->query]);

      $obj = json_decode($contents);    
           
      return new ResultsIterator($obj->outputs[0]->output->matches, SystranTranslator::results_filter(...));
    }

    public static function results_filter(mixed $match) :  SystranDictResult
    {
       /* 
         targets == definitions, often with example expressions.
        */
       $definitions = array();

       foreach($match->targets as $index => $target) { 
         
           $definitions[$index]['meaning'] = $target->lemma; 
           
           if (isset($target->expressions)) // expressions is an array that may be empty.
  
                $definitions[$index]['expressions'] = $target->expressions; 
       }
       
       return new SystranDictResult($match->source->lemma, $match->source->pos, $definitions);
    }
}
