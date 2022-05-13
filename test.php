<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\DictionaryInterface;
use LanguageTools\CollinsGermanDictionary;
use LanguageTools\ResultsIterator;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

  try {
   
    $x = RestClient::createRestClient(ClassID::Azure);

    $obj = $x->lookup("handeln", "DE", "EN"); 

    print_r($obj);

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
