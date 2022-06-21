#!/usr/bin/env php
<?php
declare(strict_types=1);
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\PonsDictionary;
use LanguageTools\ResultsIterator;
use \SplFileObject as File;

include 'vendor/autoload.php';

if ($argc != 2) {

  echo "Enter the vocabulary words input file.\n";
  return;

} else if (!file_exists($argv[1])) {

  echo "Input file does not exist.\n";
  return;
}

function display(string $word, ResultsIterator|array $iter, File $ofile)
{ 
  echo "Display results for word $word.\n"  ;
  
  $ofile->fwrite("ResultsIerator out for $word:\n"); 

  foreach($iter as $r) {
  
    $x =  print_r($r, true);

    $ofile->fwrite($x . "\n");
  }

   $ofile->fwrite("==============\n"); 
 }

try {
    $fname = $argv[1];
 
    $dict = RestClient::createClient(ClassID::Pons); 
    
    $file = new FileReader($fname);

    $ofile = new File("analysis-pons.txt", "w");
    
    foreach ($file as $word) {
        
        $word = trim($word);
                
        if ($word[0] == '#') continue;

        echo "About to add definitions for $word.\n";
        
        $a = $dict->get_german_noun_gender($word);
        print_r($a);

    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
