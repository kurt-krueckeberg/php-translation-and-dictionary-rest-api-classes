<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranTranslator extends RestClient implements TranslateInterface, DictionaryInterface {

   /*
    The Systranr 'option' query paramter can occur more than once. But I'm not sure how to specify this for Guzzle:
    I guess that would mean $thi->query['option'] = ['aaa', 'bbb', ... ];?
    */
   
   public function __construct(ClassID $id)
   {
       parent::__construct($id); 
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
    *  NOTE: Systran requires the language codes to be lowercase.
    *  If the language is not utf-8, the default, then you must speciy the encoding using the 'options' parameter.
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

       return urldecode($obj->outputs[0]->output);
   }

   final public function lookup(string $word, string $src, string $dest) : ResultsIterator
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
       // First we build the $defintions array
       // The definitions array will be the 3rd propery of the returned SystranDictResult.
       $definitions = array();

       // $match->targets[] holds the definitions. Individual defintions are in the 'lemma' property. A definition can also have example expressions.
       foreach($match->targets as $index => $target) { 
         
           $definitions[$index]['definition'] = $target->lemma; // 'lemma' is one single definition (with possible associated expressions)  

           //--if (count($target->expressions) > 0)  
  
           // expression is an array of a \stdClass with two properties: source and target.
           $definitions[$index]['expressions'] = (count($target->expressions) > 0) ? $target->expressions : array();
        }

       // We return: 1. a definition, the part-of-speech, an array (possibly empty) of associated definitions 
       return new SystranDictResult($match->source->lemma, $match->source->pos, $definitions);
    }
}
