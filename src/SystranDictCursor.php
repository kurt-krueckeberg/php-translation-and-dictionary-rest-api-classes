<?php
declare(strict_types=1);
namespace LanguageTools;

// See ../doc/dict-output-systran.txt

class SystranCursor { // This will be the 'callabe' pass to the ResultsIterator returned by SystranTranslator::lookup

   private $current_match;
   private $cur_result = array(); // object?
   
   private get_current()
   { 

      $cur_result['source_term'] = $matches->lemma;    
      $curs_reulst['pos'] = $match->source->pos;  // = Part Of Speech                                

      foreach($match->targets as $target) {

      }
      
   }

   public __construct(...)
   {
   }

}



if (count($matches) !=== 0 ) {

  foreach($matches as $match) {
     
 }


