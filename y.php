<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\WebpageCreator;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\PonsDictionary;
use LanguageTools\ClassID;
use LanguageTools\AzureConfig;

include 'vendor/autoload.php';

  try {

   $x = new WebPageCreator();
   $x = new LanguageTools\LeipzipConfig();

 //    $fetcher = RestClient::createRestClient(ClassID::Leipzig); 

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
