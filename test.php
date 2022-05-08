<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\DictionaryInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\ClassID;
use LanguageTools\ResultsIterato;

include 'vendor/autoload.php';

function display_defn(ResultsIterator $iter)
{
   foreach ($results as $result) {
        
       echo "Term:\t$result->term [$result->pos]\n";

       echo "Definitions:\n";

       foreach($result->definitions as $index => $definition) {
           
           $i = $index + 1;
           
           echo "$i. $definition->meaning\n";

           if (count($definition->expressions) != 0) echo "Expressions:\n";

           foreach ($definition->expressions as $index => $expression) {
               
               $i = $index + 1;
               
               echo "\t$i. $expression->source\t\t$expression->target\n";
           }
       }
  }
}

function test(File $file, DictionaryInterface|TranslateInterface $trans1, DictionaryInterface|TranslateInterface  $trans2)
{
  foreach ($file as $word) {
  
      echo "Definitions for '$word' :\n";

      $r1 = $trans1->lookup($word, "DE", "EN");
      print_r($r1);
      die();
/*
      $r2  = $trans2->lookup($word, "DE", "EN");
      print_r($r2);
      $debug = 10;
*/
  }
}

  try {
   
    $t1 = RestClient::createRestClient(ClassID::Azure);

    $t2  = RestClient::createRestClient(ClassID::Systran);

    $file =  new File("short-list.txt");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    test($file, $t1, $t2);

  } catch (Exception $e) {

         echo "Exception: code = " . $e->getCode() . " and message = " . $e->getMessage() . "\n";
  } 
