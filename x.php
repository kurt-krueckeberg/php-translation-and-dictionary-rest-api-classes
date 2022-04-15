<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\PonsDictionary;
use LanguageTools\WebpageCreator;
use LanguageTools\Translator;

include 'vendor/autoload.php';

  try {

    $xml = \simplexml_load_file("config.xml");
  
    $p = new PonsDictionary($xml);
    
    $p->lookup("Handeln", "DE", "EN");
    
    $debug = 10;
    
    ++$debug;

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
