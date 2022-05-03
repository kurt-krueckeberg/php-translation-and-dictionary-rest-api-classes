<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranResultsIterator extends ResultsIterator  {

    protected function get_result(mixed $match) : \stdClass //mixed
    { 
       // See ../doc/dict-systran.txt for layout of results returned by Systran lookup call

      $result = new \stdClass;

      $result->term = $match->source->lemma;    
      $result->pos = $match->source->pos;  // = Part Of Speech                                

      $result->definitions = array();

      foreach($match->targets as $index => $target) { // target == definition

          /* 
           * Each $results->term will have an array of definitions (with maybe only one dfinition in it) and...
           * 
           * ...with each defintion there can be an array of example expressions... 
           * 
           * ... These expressions will have 'source' and 'target' properties.
           */
          $result->definitions[$index] = new \stdClass;
          
          $result->definitions[$index]->meaning= $target->lemma; 
          
          
          if (isset($target->expressions)) {

               $result->definitions[$index]->expressions = $target->expressions;
               
           }   
           
      }
      
      return $result;
   }
   
   public function __construct(array $objs) 
   {
          parent::__construct($objs);
   }
}
