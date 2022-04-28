<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\WebpageCreator;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\DictionaryInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\Systran;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

  try {
   
    $systran = RestClient::createRestClient(ClassID::Systran);

    $translation = $systran->translate("Handeln", "EN", "DE"); 
       
    echo "is: " . $translation . "\n";

  } catch (Exception $e) {

         echo "Exception: code = " . $e->getCode() . " and message = " . $e->getMessage() . "\n";
  } 
