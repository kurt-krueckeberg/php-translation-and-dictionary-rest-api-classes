<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\HtmlBuilder;

include 'vendor/autoload.php';

try {
   
    $t = RestClient::createClient(ClassID::Systran); 
    
    $f = new FileReader("vocab.txt");
    
    $b = new HtmlBuilder("german.html");
   
    $cnt = 0;
    foreach ($f as $word) {
        
        $iter = $t->lookup($word, 'de', 'en');
        /*
        foreach($iter as $defns)  {

            echo 'word: ' . $defns->term . "\n";                 // ignore
            echo "\tpart-of-speech: "  . $defns->pos . "\n";    // display
 
            foreach ($defns->definitions as $defn) {

                 echo "\tdefinition = " . $defn['definition'] . "\n";

                 if (isset($defn['expressions'])) {
                     
                    echo "\t\texpressions:\n"; 

                    foreach ($defn['expressions'] as $expression) 

                            echo "\t\t\t". $expression->source  . " - ". $expression->target . "\n";
                   }  
            } 
        }         
        */
        $b->add_lookup_results($iter);


        if (++$cnt == 3) return;
        
    }
    $b->save();
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
