<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID: string {

   case  Leipzig = "l"; // ClassID::Leipzig->value == "l"
   case  Pons = "p";    // etc
   case  Systrans = "s";
   case  Azure = "a";
   case  Ibm = "i";
   case  Yandex = "y";
   case  Deepl = "d";
}
