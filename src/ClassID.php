<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID implements ClassmapperInterface 
{
   case  Leipzig;
   case  Pons;
   case  Systran;
   case  Azure;
   case  Ibm;
   case  Deepl;
    
    public function class_name() : string
    {
        return match($this) { // Returns implementation class
            ClassID::Leipzig  => "LanguageTools\UniLeipzigSentenceFetcher", 
            ClassID::Pons     => "LanguageTools\PonsDictionary",   
            ClassID::Systran  => "LanguageTools\SystranTranslator",
            ClassID::Azure    => "LanguageTools\AzureTranslator",
            ClassID::Ibm      => "LanguageTools\IbmTranslator",
            ClassID::Deepl    => "LanguageTools\DeeplTranslator",
        };
     }
   
    /* 
    This method returns the configuration class name for the corresponding implementation class above.
    However, PHP 8.1 now allows you to use 'new' to initialize default constructor parameters (or any other function's).
    public function config_name() : string
    {
        return match($this) {
            ClassID::Leipzig  => "LanguageTools\UniLeipzigConfig", 
            ClassID::Pons     => "LanguageTools\PonsConfig",
            ClassID::Deepl    => "LanguageTools\DeeplConfig",
            ClassID::Azure    => "LanguageTools\AzureConfig",
            ClassID::Ibm      => "LanguageTools\IbmConfig",
            ClassID::Systran  => "LanguageTools\SystranConfig",
        };
     }
     */
}
