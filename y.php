<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\DictionaryInterface;
use LanguageTools\ResultsIterator;
use LanguageTools\CollinsGermanDictionary;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

try {
   
  $file =  new File("test.txt", "r");
    
  $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

  $trans = new CollinsGermanDictionary();

  foreach ($file as $word) {
  
      // The size of $examples_array will be the same as the $definitions.
      //$definitions = $trans->lookup($word, "DE", "EN"); 
      $definitions = $trans->lookup('Handeln', "DE", "EN"); 
      
      if (count($definitions) == 0) {

           echo "There are no definitions for '$word'.\n";
      } 

      print_r($definitions);
      echo "---------------\n";
  }  

 
} catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
} 
