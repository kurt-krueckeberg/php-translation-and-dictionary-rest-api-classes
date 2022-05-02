<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranResultsIterator extends ResultsIterator  {

    protected function get_result(mixed $match) : \stdClass //mixed
    { 
      return new Definition($match->source->lemma,    
                             $match->source->pos,  // = Part Of Speech                                

      // See ../doc/dict-systran.txt 
      $efinitions = array();

      /*
        There can be mulitple targets for '$match->srouce->lemma`.
        Targets are definitions. So more than one target implies more than one definition.
        And for each such target, while there will be one definition string, there could be an array
        of expressions illustrating the use of this particular definition.

        todo: What is the layout of $target? Should be keep it, but only return:
           $target->lemma as the definition
           $target->expressions ... as an array of example expressions.   

        */
      foreach($match->targets as $target) {
          /* todo:
           * 
           * add the definition
           * $result->definition
           * 
           * Loop over any expressions to get the 'source' and 'target' properties
           * $results->expressions
           */
          $definitions[] = $target->lemma;
          
          if (isset($target->expressions)) $result->expressions = $target->expressions;
      }
      
      return $result;
   }
   
   public function __construct(array $objs) 
   {
          parent::__construct($objs);
   }
}
