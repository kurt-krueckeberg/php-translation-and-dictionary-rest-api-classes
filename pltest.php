#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\DlHtmlBuilder;

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
 
    $trans = RestClient::createClient(ClassID::Systran); 

    $leipzig = RestClient::createClient(ClassID::Leipzig); 

    $collins = RestClient::createClient(ClassID::Collins); 
    
    $file = new FileReader($fname);
    
    $html = new DlHtmlBuilder($argv[2] . ".html", "de", "en", $collins, $trans, $trans, $leipzig);
   
    foreach ($file as $word) {
        
        if ($word[0] == '#') continue;
        
        echo "About to add definitions for $word.\n";
        
        $cnt = $html->add_definitions($word, "de", "en");

        echo "Added $cnt definitions for $word.\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
