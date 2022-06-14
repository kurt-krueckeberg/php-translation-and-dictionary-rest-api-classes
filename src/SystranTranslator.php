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

    // results_filter(mixed $match) returns a SystranDictResultthat has three properties: 1. the word being defined ($match->source->lemma) 2. its part-of-speech ($match->source->pos) 3. an array of definitions that hss two elements:
    // 1. 'definition', a definition, and 2. an array 'expressions' of zero or more associated expressions.
    public static function results_filter(mixed $match) :  SystranDictResult
    {
       // First ,we create SystranDictResult::definitions, the array of definitions.       
       $definitions = array();

       /* Each $target below holds: 1. a definition in $target['lemma'], 2. the part of speech in $target['pos'] and 3. zero or more example/usage expressions. :w*/
       foreach($match->targets as $index => $target) { 
         
           $definitions[$index]['definition'] = $target->lemma; 
  
           // expression is an array of a \stdClass objects that have two properties: source and target.
           $definitions[$index]['expressions'] = (count($target->expressions) > 0) ? $target->expressions : array();
        }

       return new SystranDictResult($match->source->lemma, $match->source->pos, $definitions); // TODO: <--- Is this correct?
    }
}
