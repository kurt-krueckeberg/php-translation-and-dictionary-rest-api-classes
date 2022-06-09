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
    $cnt = 3;

    foreach ($f as $word) {
        
        $defns = $t->lookup($word, 'de', 'en');
        
        foreach($defns as $def)  {

             print_r($def);
        }

        if ($cnt-- == 0 ) break; 
         
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
