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

        if (count($iter) == 0) continue;

        echo "<div class="defn"><h1 class="hwd">$word</h1>...pos
         
        foreach($iter as $defns)  {

            echo 'word: ' . $defns->term . "\n";                 // ignore
            echo "\tpart-of-speech: "  . $defns->pos . "\n";    // display
 
            echo "<ul>\n"; 

            foreach ($defns->definitions as $defn) {

                 echo "<li>" . $defn['definition'] . "</li>\n";

                 if (isset($defn['expressions'])) {
                     
                    echo "<ul>\n"; 

                    foreach ($defn['expressions'] as $expression) 

                            echo "<li>". $expression->source  . " - ". $expression->target . "</li>\n";

                    echo "</ul>\n";
                 }  
            } 

            echo "</ul>\n";
        }
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
