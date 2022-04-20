<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\AzureTranslator;
use LanguageTools\RestClient;

include 'vendor/autoload.php';
  try {

    $xml = \simplexml_load_file("config.xml");
  
    $azure = RestClient::createRestClient($xml, "m"); 

    $azure->getTranslationLanguages();

    } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
