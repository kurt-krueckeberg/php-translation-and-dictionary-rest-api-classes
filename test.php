#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\{RestClient, ClassID, FileReader, HtmlBuilder, PonsNounFetcher, PonsDictionary, DictionaryInterface};

include 'vendor/autoload.php';

if ($argc != 3) {

  echo "Enter the vocabulary words input file follow by html file name (without .html).\n";
  return;

} else if (!file_exists($argv[1])) {


  echo "Input file does not exist.\n";
  return;
}

function test(string $word, DictionaryInterface $dict, $nfetcher)
{
  $iter = $dict->lookup($word, "de", "en"); 

  if (count($iter) > 0) {

      // If Noun (Tn the utf-8 (code point collection) lowercase characters
      // have a larger code point values than uppercase)   
      if ($word[0] >= 'A' && $word[0] <= 'Z' ) { 
         
          $info = $nfetcher->get_noun_info($word);       

          echo "Printing gender and plural of @word.\n";

          print_r($info);
      } 
  } else {
      
      echo "No definition found for $word\n";
  } 
}

try {

    $fname = $argv[1];
 
    $file = new FileReader($fname);
        
    $dict = RestClient::createClient(ClassID::Systran);

    $nfetcher = new PonsNounFetcher(new PonsDictionary());
 
    foreach ($file as $word) {
        
        $word = trim($word);
                
        if ($word[0] == '#') continue;
        
        test($word, $dict, $nfetcher);
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
