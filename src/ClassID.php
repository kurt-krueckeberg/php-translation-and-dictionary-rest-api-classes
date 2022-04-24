<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID implements ClassmapperInterface 
{
   case  Leipzig;
   case  Pons;
   case  Systrans;
   case  Azure;
   case  Ibm;
   case  Deepl;

    // Returns implementation class.
    public function class_name() : string
    {
        return match($this) {
            ClassID::Leipzig  => "LanguageTools\SentenceFetcher", 
            ClassID::Pons     => "LanguageTools\PonsDictionary",   
            ClassID::Systrans => "LanguageTools\SystransTranslator",
            ClassID::Azure    => "LanguageTools\AzureTranslator",
            ClassID::Ibm      => "LanguageTools\IbmTranslator",
            ClassID::Deepl    => "LanguageTools\DeeplTranslator",
        };
     }
   
    // Returns config class name for the above implementation classes.
    public function config_name() : string
    {
        return match($this) {
            ClassID::Leipzig  => "LanguageTools\LeipzipConfig",
            ClassID::Pons     => "LanguageTools\PonsConfig",
            ClassID::Deepl    => "LanguageTools\DeeplConfig",
            ClassID::Azure    => "LanguageTools\AzureConfig",
            ClassID::Ibm      => "LanguageTools\IbmConfig",
            ClassID::Systrans => "LanguageTools\SystransConfig",
        };
     }
}
