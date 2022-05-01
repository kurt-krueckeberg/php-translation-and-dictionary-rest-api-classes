<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\DictionaryInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

function test(File $file, DictionaryInterface $translator, SentenceFetchInterface $fetcher)
{

  foreach ($file as $word) {
  
      echo "Definitions '$word' :\n";

      $translator->lookup($word, "DE", "EN");


/* ************ 
      echo "Fetching '$word' examples:\n";

      // Fetch sentences and translate them.          
      foreach ( $fetcher->fetch($word, 3) as $sentence) {

           echo "Translation of: " . $sentence . "\n";

           // The 2nd parameter is destination language. iThe 3rd parameter is the optional
           //  source language (if it is ommitted, the source language is automatically detected).
           $translation = $translator->translate($sentence, "EN", "DE"); 
           
           echo "is: " . $translation . "\n";
           
      }
      echo "\n";
*/
   }
}

  try {
   
    $trans = RestClient::createRestClient(ClassID::Pons);
    $fetcher = RestClient::createRestClient(ClassID::Leipzig);
 
    $file =  new File("short-list.txt");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    test($file, $trans, $fetcher);

  } catch (Exception $e) {

         echo "Exception: code = " . $e->getCode() . " and message = " . $e->getMessage() . "\n";
  } 
