<?php
declare(strict_types=1);
namespace LanguageTools;

class LeipzigResultsIterator extends ResultsIterator { 

   protected function get_result(mixed $x) : \stdClass 
   { 
       return $x->sentence; 
   }
   
   public function __construct(array $objs) 
   {
          parent::__construct($objs);
   }
}
