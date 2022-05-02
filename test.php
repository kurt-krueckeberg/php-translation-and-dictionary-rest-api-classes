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

      $definitions = $translator->lookup($word, "DE", "EN");
      
      echo "print_f() of definitions for $word.\n";
      
      foreach ($definitions as $result) {
          
         $debug = 10;
          print_r($result);
      }
   
       echo "\n--------End of Definitions for $word ------------\n";
    }
}

  try {
   
    $trans = RestClient::createRestClient(ClassID::Systran);
    $fetcher = RestClient::createRestClient(ClassID::Leipzig);
 
    $file =  new File("short-list.txt");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    test($file, $trans, $fetcher);

  } catch (Exception $e) {

         echo "Exception: code = " . $e->getCode() . " and message = " . $e->getMessage() . "\n";
  } 
