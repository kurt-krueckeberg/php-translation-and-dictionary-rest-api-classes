<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID: string {

   case   PONS = "p";
   case   SYSTRANS = "s";
   case   AZURE = "a";
   case   IBM = "i";
   case   YANDEX = "y";
   case   DEEPL = "d";

    public function text() : string
    {
        return match ($this) {
            self::PONS => 'p',
            etc
        };
    }
}
