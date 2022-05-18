<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID implements ClassmapperInterface {

   case  Leipzig;
   case  Systran;
   case  Azure;
   case  Ibm;
   case  Deepl;
    
   public function class_name() : string
   {
       return match($this) { // Returns implementation class
           ClassID::Leipzig  => "LanguageTools\LeipzigSentenceFetcher", 
           ClassID::Systran  => "LanguageTools\SystranTranslator",
           ClassID::Azure    => "LanguageTools\AzureTranslator",
           ClassID::Ibm      => "LanguageTools\IbmTranslator",
           ClassID::Deepl    => "LanguageTools\DeeplTranslator"
       };
   }

   public function get_provider() : string
   {
       return match($this) { // Returns implementation class's abbreviation used in 'config.xml'
           ClassID::Leipzig  => "l",
           ClassID::Systran  => "s",
           ClassID::Azure    => "a",
           ClassID::Ibm      => "i",
           ClassID::Deepl    => "d"
       };
   }
}
