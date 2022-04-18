<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\DictionaryInterface;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\TranslatorWithDictionary;

include 'vendor/autoload.php';

function f(TranslatorWithDictionary $t)
{
 echo   $t->translate("Handeln", "EN", "DE");
}

  try {

    $xml = \simplexml_load_file("config.xml");
  
    $Azure = RestClient::createRestClient($xml, "m"); 

    f($Azure);

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
