#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;

include 'vendor/autoload.php';

if ($argc != 3) {

  echo "Enter the vocabulary words input file follow by html file name (without .html).\n";
  return;

} else if (!file_exists($argv[1])) {


  echo "Input file does not exist.\n";
  return;
}

try {
    $fname = $argv[1];
 
    $dict = RestClient::createClient(ClassID::Pons); 
    
    $file = new FileReader($fname);
    
    foreach ($file as $word) {
        
        $word = trim($word);
                
        if ($word[0] == '#') continue;

        echo "About to add definitions for $word.\n";
        
        $cnt = $dict->search($word, "de", "en");

        echo "Added $cnt definitions for $word.\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
