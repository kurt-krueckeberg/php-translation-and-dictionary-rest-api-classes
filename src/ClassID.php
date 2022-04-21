<?php
declare(strict_types=1);
namespace LanguageTools;

enum ClassID implements ClassmapInterface 
{
   case  Leipzig;
   case  Pons;
   case  Systrans;
   case  Azure;
   case  Ibm;
   case  Yandex;
   case  Deepl;

    // Fulfills the interface contract.
    public function class_name() : string
    {
        return match($this) {
            ClassID::Leipzig  => "LanguageTools\SentenceFetcher", 
            ClassID::Pons     => "LanguageTools\PonsDictionary",   
            ClassID::Systrans => "LanguageTools\SystransTranslator",
            ClassID::Azure    => "LanguageTools\AzureTranslator",
            ClassID::Ibm      => "LanguageTools\IbmTranslator",
            ClassID::Yandex   => "LanguageTools\YandexTranslator",
            ClassID::Deepl    => "LanguageTools\DeeplTranslator",
        };
     }
   
    public function get_config_name() : string
    {
        return match($this) {
            ClassID::Leipzig  => "LeipzipConfig",
            ClassID::Pons     => "PonsConfig",
            ClassID::Deepl    => "DeeplConfig",
            ClassID::Azure    => "AzureConfig",
            ClassID::Ibm      => "IbmConfig",
            ClassID::Yandex   => "YandexConfig",
            ClassID::Systrans => "SystransConfig",
        };
     }
}
