<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID implements ClassmapperInterface 
{
   case  Leipzig;
   case  Systran;
   case  Azure;
   case  Ibm;
   case  Deepl;
/* case  Pons; */
    
    public function class_name() : string
    {
        return match($this) { // Returns implementation class
            ClassID::Leipzig  => "LanguageTools\LeipzigSentenceFetcher", 
            ClassID::Systran  => "LanguageTools\SystranTranslator",
            ClassID::Azure    => "LanguageTools\AzureTranslator",
            ClassID::Ibm      => "LanguageTools\IbmTranslator",
            ClassID::Deepl    => "LanguageTools\DeeplTranslator",
        /*  ClassID::Pons     => "LanguageTools\PonsDictionary",   */
        };
     }
   
    /* 
    This method returns the configuration class name for the corresponding implementation class above.
    However, PHP 8.1 now allows you to use 'new' to initialize default constructor parameters (or any other function's).
    public function config_name() : string
    {
        return match($this) {
            ClassID::Leipzig  => "LanguageTools\LeipzigConfig", 
            ClassID::Pons     => "LanguageTools\PonsConfig",
            ClassID::Deepl    => "LanguageTools\DeeplConfig",
            ClassID::Azure    => "LanguageTools\AzureConfig",
            ClassID::Ibm      => "LanguageTools\IbmConfig",
            ClassID::Systran  => "LanguageTools\SystranConfig",
        };
     }
     */
}
