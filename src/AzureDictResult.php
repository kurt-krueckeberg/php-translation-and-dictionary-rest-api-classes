<?php
declare(strict_types=1);
namespace LanguageTools;


class  AzureDictResult {
   /* 
      The constructor simply creates and assigns the part-of-speech and a one-word definition.
    */
   public function __construct(public readonly string $pos, public readonly $definition) 
   {
       
   }
}
