<?php
declare(strict_types=1);
namespace LanguageTools;

class PonsResultsIterator extends ResultsIterator  {

    private static string $entry = 'entries';
    private bool has_entries;

    protected function get_result(mixed $obj) : \stdClass //mixed
    { 
       $results = mew \stdClass;

        
        
       if (is_null($obj) || count($obj->hits) == 0) 
                   return $results;
                  
              foreach ($obj->hits as $hit_array) {
              
                    if (count($hit_array->roms) == 0) 
                        continue;
                    
                    foreach($hit_array->roms as $rom_array) {
              
                         if (count($rom_array->arabs) == 0)
                             continue;
                      
                          foreach ($rom_array->arabs as $arabs_array) {
                              
                              if (count($arabs_array->translations) == 0)
                                 continue;
                      
                              foreach($arabs_array->translations as $translation) {
                      
                                    $results[] = $translation;//strip_tags($translation->target);
                               }  
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
       $this->has_entries = ($objs->type == self::$entry) ? true : false;
 
   }
}
