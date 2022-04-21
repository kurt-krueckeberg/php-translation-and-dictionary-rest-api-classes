<?php
declare(strict_types=1);
namespace LanguageTools;

class Config {

  
  public static function getConfg(ClassID $id)
  {
    switch($id) {
    case ClassID::LEIPZIG:
     return new
      break;

    case ClassID::PONS:
     return new
      break;

    case ClassID::SYSTRANS:
     return new
      break;

    case ClassID::AZURE:
     return new
      break;

    case ClassID::IBM:
     return new
      break;

    case ClassID::YANDEX:
     return new
      break;

    case ClassID::DEEPL:
     return new
      break;

   }
  }
}
