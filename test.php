<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\HtmlBuilder;
use LanguageTools\DlHtmlBuilder;

include 'vendor/autoload.php';


try {
 
    $trans = RestClient::createClient(ClassID::Systran); 

    $trans->lookup("Hund", "de", "en");       
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
