<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\DictionaryInterface;
use LanguageTools\ResultsIterator;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

  try {
   
    $file =  new File("test.txt", "r");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

  $trans = new NewCollinsDictionary();

  foreach ($file as $word) {
  
      // The size of $examples_array will be the same as the $definitions.
      $definitions = $trans->lookup($word, "DE", "EN"); 
      
      if (count($definitions) == 0) {

           echo "There are no definitions for '$word'.\n";
           continue;
      } 
   }  

    test($file);

 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
