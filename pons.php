#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use \LanguageTools\PonsDictionary;
use LanguageTools\ResultsIterator;

include 'vendor/autoload.php';

if ($argc != 2) {

  echo "Enter the vocabulary words input file.\n";
  return;

} else if (!file_exists($argv[1])) {

  echo "Input file does not exist.\n";
  return;
}

function display(ResultsIterator $iter)
{
  foreach($iter as $r) {
     
     print_r($r);
   }
    
}

try {
    $fname = $argv[1];
 
    $dict = RestClient::createClient(ClassID::Pons); 
    
    $file = new FileReader($fname);
    
    foreach ($file as $word) {
        
        $word = trim($word);
                
        if ($word[0] == '#') continue;

        echo "About to add definitions for $word.\n";
        
        $iter = $dict->search($word, "de", "en");

        echo "Added " . count($iter) . " definitions for $word.\n";
        
        display($iter);
        
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
