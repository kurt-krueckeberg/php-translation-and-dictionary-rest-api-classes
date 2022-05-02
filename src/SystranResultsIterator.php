<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranResultsIterator extends ResultsIterator  {

    protected function get_result(mixed $match) : \stdClass //mixed
    { 
      $result = new \stdClass;
      
      $result->word = $match->source->lemma;    
      $result->pos = $match->source->pos;  // = Part Of Speech                                

      // See ../doc/dict-systran-output.txt for what to reslut

      foreach($match->targets as $target) {
          /* todo:
           * 
           * add the definition
           * $result->definition
           * 
           * Loop over any expressions to get the 'source' and 'target' properties
           * $results->expressions
           */
          $result->word_definition = $target->lemma;
          
          if (isset($target->expressions)) 
              
              $result->expressions = $target->expressions;
          
      }
      
      return $result;
      
   }
   
   public function __construct(array $objs) 
   {
          parent::__construct($objs);
   }
}
