<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\DictionaryInterface;
use LanuageTools\CollinsGermanDictionary;
use LanguageTools\ResultsIterator;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

  try {
   
    $dict = new CollinsGermanDictionary();

    $obj = $dict->lookup("Handeln"); 

    print_r($obj);

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
