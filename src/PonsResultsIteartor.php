<?php
declare(strict_types=1);
namespace LanguageTools;

class PonsResultsIterator extends ResultsIterator  {

    private static string $entry = 'entries';
    private bool has_entries;

    protected function get_result(mixed $obj) : \stdClass //mixed
    { 
       $results = mew \stdClass;

        foreach ($obj->hits as $hit) {
        
              if (count($hit->roms) == 0) 
                  continue;
              
              foreach($hit->roms as $rom) {

                   $rom->headword OR $rom->headword_full is he term bein defined
         
                   if (count($rom->arabs) == 0)
                       continue;
                
                    foreach ($rom->arabs as $arab) {
                        
                        if (count($arab->translations) == 0)
                           continue;
                
                        foreach($arab->translations as $translation) {
                
                              $results[] = $translation;//strip_tags($translation->target);
                         }  
                    }
               }
        }

   
   public function __construct(array $objs) 
   {
       parent::__construct($objs);

        /*
         * Does response have 'entries' (which seems to mean, iI guess, dicitonary entries. If not translationsa are searched.
         * 
         */  
      if (is_null($obj) || count($obj->hits) == 0) 
             // Then there are no results.
        
       $this->has_entries = $obj->hits[0]->type == "entry" ? true : false;   
   }
}
