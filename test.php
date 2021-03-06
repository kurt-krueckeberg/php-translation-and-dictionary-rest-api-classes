#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\{RestClient, ClassID, FileReader, HtmlBuilder, PriorHtmlBuilder};

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
 
    $file = new FileReader($fname);
    
    $html = new HtmlBuilder($argv[2], "de", "en", ClassID::Collins);

    foreach ($file as $word) {

        echo "About to add definitions for $word.\n";

        $cnt = $html->add_definitions($word); 

/*

        echo "Looking for samples sentences for $word.\n";
        $cnt = $html->add_samples($word, 3); 

  
*/      echo "Added $cnt samples sentences for $word.\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
