<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\ResultfileInterface;
use LanguageTools\SentenceFetchInterface;

include 'vendor/autoload.php';

try {
   
    $trans = RestClient::createClient(ClassID::Systran); 

    $leipzig = RestClient::createClient(ClassID::Leipzig); 
    
    $file = new FileReader("vocab.txt");
    
    $html = new HtmlBuilder("german.html", $trans, $trans, $leipzig); 
   
    foreach ($file as $word) {
        
        $html->add_definitions($word, "de", "en");

        $html->add_samples($leipzig, $word, 3); 
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
