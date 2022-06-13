<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\HtmlBuilder;

include 'vendor/autoload.php';

try {
   
    $trans = RestClient::createClient(ClassID::Systran); 

    $leipzig = RestClient::createClient(ClassID::Leipzig); 
    
    $file = new FileReader("vocab.txt");
    
    $html = new HtmlBuilder("german.html", "de", "en", $trans, $trans, $leipzig);
   
    foreach ($file as $word) {

        echo "Adding definitions for $word.\n";
        
        $html->add_definitions($word, "de", "en");

        echo "Adding samples sentences.\n";

        $html->add_samples($word, 3); 
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
