#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\ClassID;
use LanguageTools\FileReader;
use LanguageTools\HtmlBuilder;
use LanguageTools\DlHtmlBuilder;

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
 
    $trans = RestClient::createClient(ClassID::Systran); 

    $leipzig = RestClient::createClient(ClassID::Leipzig); 
    
    $file = new FileReader($fname);
    
    $html = new DlHtmlBuilder("german.html", "de", "en", $trans, $trans, $leipzig);
   
    foreach ($file as $word) {
        
        $cnt = $html->add_definitions($word, "de", "en");

        echo "Added $cnt definitions for $word.\n";

        $cnt = $html->add_samples($word, 3); 

        echo "Added $cnt samples sentences for $word.\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
