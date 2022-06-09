<?php
declare(strict_types=1);
namespace LanguageTools;


class  SystranDictResult {

   public function __construct(public readonly string $term, public readonly string $pos, public readonly array $definitions) 
   {
   }
}
