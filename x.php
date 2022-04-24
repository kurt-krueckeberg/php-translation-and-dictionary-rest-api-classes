<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\AzureConfig;
use LanguageTools\PonsConfig;

include 'vendor/autoload.php';

  try {

   $x2 = new PonsConfig();

 //    $fetcher = RestClient::createRestClient(ClassID::Leipzig); 

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
