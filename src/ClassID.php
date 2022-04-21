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
            ClassID::Leipzig  => "",
            ClassID::Pons     => "",
            ClassID::Deepl    => "",
            ClassID::Azure    => "",
            ClassID::Ibm      => "",
            ClassID::Yandex   => "",
            ClassID::Systrans => "",
        };
     }
}

/*
function test(ClassID $id)
{
  $x = $id->class_name();
  echo "The ClassID's class_name is = " . $id->class_name() ."\n";
}

test(ClassID::Azure);

enum ID  : string 
{
   case  Leipzig = "Leipzig"; 
   case  Pons = "Pons";   
   case  Systrans = "Systrans";
   case  Azure = "Azure";
   case  Ibm = "Ibm";
   case  Yandex = "Yandex";
   case  Deepl = "Deepl";

}


function t(ID $id)
{
  echo "The ID's ->value is = " . $id->value ."\n";
}

t(ID::Pons);
return;
*/
