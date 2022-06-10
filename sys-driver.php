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
        
        $iter = $t->lookup($word, 'de', 'en');
        
        foreach($iter as $defns)  {

            echo 'word: ' . $defns->term . "\n";
            echo "\tpart-of-speech: "  . $defns->pos . "\n";
 
            foreach ($defns->definitions as $defn) {

                 echo "\tdefinition = " . $defn['definition'] . "\n";

                 if (isset($defn['expressions'])) {
                     
                    echo "\t\texpressions:\n"; 

                    foreach ($defn['expressions'] as $expression) 

                            echo "\t\t\t". $expression->source  . " - ". $expression->target . "\n";
                   }  
            } 
        }
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
