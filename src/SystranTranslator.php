<?php
declare(strict_types=1);
namespace LanguageTools;

// Under development
class SystranTranslator extends RestClient implements TranslateInterface, DictionaryInterface {

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
      static $trans_languages = array('method' => "GET", 'route' => "translation/supportedLanguages");

      $contents = $this->request($trans_languages['method'], $trans_languages['route']);
             
      return json_decode($contents, true);
   } 

   final public function getDictionaryLanguages() : array
   {
      static $dict_languages = array('method' => "GET", 'route' => "resources/dictionary/supportedLanguages");

      $contents = $this->request($dict_languages['method'], $dict_languages['route']);
             
      return json_decode($contents, true);    
   } 

   /*
    *  Systran requires the language codes to be lowercase.
    *  If the language is not utf-8, then you must speciy the encoding using the 'options' parameter.
    */
   final public function translate(string $text, string $dest, $src="") : string 
   {
       static $trans = array('method' => "POST", 'route' => "translation/text/translate");

       $query = array();
       
       if ($src !== '') 
           $query['source'] = strtolower($src);
       
       $query['target'] = strtolower($dest);
       
       $query['input'] = $text;
       
       $contents = $this->request($trans['method'], $trans['route'], ['query' => $query]); 

       $obj = json_decode($contents);

      /*
       * The layout of the results is documented at https://docs.systran.net/translateAPI/translation/#tag-Translation
       */
       return urldecode($obj->outputs[0]->output);
   }

   /*
    * The layout of the results json object is described in /doc/dict-systrans.txt
    */
   final public function lookup(string $word, string $src_lang, string $dest_lang) : ResultsIterator
   {      
      static $lookup = array('method' => "GET", 'route' => "resources/dictionary/lookup");

      $query = array();
      
      if ($src !== '') 
          $query['source'] = strtolower($src);
      
      $query['target'] = strtolower($dest);
      
      $query['input'] = $word;// urlencode($text);  

      $contents = $this->request($lookup['method'], $lookup['route'], ['query' => $query]);

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
