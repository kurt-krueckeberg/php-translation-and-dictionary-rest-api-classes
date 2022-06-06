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

  echo CollinsGermanDictionary::get_css();

  $trans = new CollinsGermanDictionary();

  foreach ($file as $word) {
      
      $def = $trans->get_best_matching($word);

      if (is_null($def))       
         echo "is null\n";
      
      else
         echo "$def\n";
  }  

 
} catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
} 
