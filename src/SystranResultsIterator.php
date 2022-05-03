<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranResultsIterator extends ResultsIterator  {

   /*
       Returns a stdClass with these properties:

       term - being defined
       pos  - part of speech
       definitions - stdClass with properites:
                           1. meaning | string
                           2. Any associated example epxressions | array
    */

    protected function get_result(mixed $match) : \stdClass 
    { 
       // See doc/dict-systran.txt for result response details for lookup call.

      $result = new \stdClass;

      $result->term = $match->source->lemma; // word being defined   
      $result->pos = $match->source->pos;    // pos == Part Of Speech                                

      $result->definitions = array();

      /* 
        targets == definitions, often with example expressions.
       */
      foreach($match->targets as $index => $target) { 

          $result->definitions[$index] = new \stdClass;
          
          $result->definitions[$index]->meaning= $target->lemma; 
          
          if (isset($target->expressions)) // expressions is an array

               $result->definitions[$index]->expressions = $target->expressions; 
      }
      
      return $result;
   }
   
   public function __construct(array $objs) 
   {
          parent::__construct($objs);
   }
}
