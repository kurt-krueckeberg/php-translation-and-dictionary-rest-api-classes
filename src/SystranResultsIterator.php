<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranResultsIterator extends ResultsIterator  {

    protected function get_result(mixed $match)
    { 

      $cur_result['source_term'] = $match->lemma;    
      $curs_reulst['pos'] = $match->source->pos;  // = Part Of Speech                                

      // See ../doc/dict-systran-output.txt for what to reslut

      foreach($match->targets as $target) {
          //...
      }
      
   }
   
   public function __construct(array $objs) 
   {
          parent::__construct($objs);
   }
}
