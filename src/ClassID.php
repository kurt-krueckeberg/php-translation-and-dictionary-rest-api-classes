<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID implements ClassmapperInterface {

   case  Leipzig;
   case  Systran;
   case  Azure;
   case  Ibm;
   case  Deepl;
   case  Collins;
   case  Pons;
   case  iTranslate;
    
   public function class_name() : string
   {
       return match($this) { // Returns implementation class
           ClassID::Leipzig  => "LanguageTools\LeipzigSentenceFetcher", 
           ClassID::Systran  => "LanguageTools\SystranTranslator",
           ClassID::Azure    => "LanguageTools\AzureTranslator",
           ClassID::Ibm      => "LanguageTools\IbmTranslator",
           ClassID::Deepl    => "LanguageTools\DeeplTranslator",
           ClassID::Collins  => "LanguageTools\CollinsGermanDictionary",
           ClassID::Pons     => "LanguageTools\PonsDictionary",
           ClassID::iTranslate  => "LanguageTools\iTransTranslator"
       };
   }

   public function get_provider() : string
   {
       return match($this) { // Returns implementation class's abbreviation used in 'config.xml'
           ClassID::Leipzig  => "leipzig",
           ClassID::Systran  => "systran",
           ClassID::Azure    => "azure",
           ClassID::Ibm      => "ibm",
           ClassID::Deepl    => "deepl",
           ClassID::Collins  => "collins",
           ClassID::Pons     => "pons",
           ClassID::iTranslate  => "itranslate"
       };
   }
}
