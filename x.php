<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

  try {
   
    $trans = RestClient::createRestClient(ClassID::Deepl);

    $translation = $trans->translate("Handeln", "EN", "DE"); 
       
     print_r($translation); 

  } catch (Exception $e) {

         echo "Exception: code = " . $e->getCode() . " and message = " . $e->getMessage() . "\n";
  } 
