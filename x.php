#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\CollinsGermanDictionary;

include 'vendor/autoload.php';

if ($argc != 2) {

  echo "Enter the vocabulary words input file.\n";
  return;

} else if (!file_exists($argv[1])) {


  echo "Input file does not exist.\n";
  return;
}

try {
    $fname = $argv[1];
 
    $t= RestClient::createClient(ClassID::Collins); 
    
    $file = new FileReader($fname);
    
    foreach ($file as $word) {
        
        echo "About to add definitions for $word.\n";
        
        $d = $t->get_best_matching($word);

        echo "$d\n"; 
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
