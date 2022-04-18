<?php
declare(strict_types=1);
namespace LanguageTools;

interface LanguagesSupportedInterface {

   /*
         todo: string is not the correct return type. Array or stdClass probably is.
    */
   public function getLanguages() : string;
}
