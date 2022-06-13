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
    
    $file = new FileReader("vocab.txt");
    
    $html = new HtmlBuilder("german.html");
   
    foreach ($file as $word) {
        
        $iter = $trans->lookup($word, 'de', 'en');

        $html->add_definitions($iter);

        // todo: Add leipzig sample sentences
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
