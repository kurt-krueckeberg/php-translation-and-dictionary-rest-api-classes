<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;

include 'vendor/autoload.php';

try {
   
    $t = RestClient::createClient(ClassID::Systran); 
    
    $f = new FileReader("vocab.txt");

    foreach ($f as $word) {
        
        $en = $t->lookup($word, 'de', 'en');

        echo "$en\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
