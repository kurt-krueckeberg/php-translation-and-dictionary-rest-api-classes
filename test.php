<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\DictionaryInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\ClassID;
use LanguageTools\ResultsIterator;

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

function test(File $file, DictionaryInterface|TranslateInterface $trans)
{
  foreach ($file as $word) {
  
      echo "Definitions for '$word' :\n";

      $r = $trans->lookup($word, "DE", "EN");
      
      print_r($r);
      
      echo "Examples for '$word' :\n";
      
      $x  = $trans->examples($word, $r);
      print_r($x);
  }
}

  try {
   
    $t = RestClient::createRestClient(ClassID::Azure);

    $file =  new File("short-list.txt");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    test($file, $t);

  } catch (Exception $e) {

         echo "Exception: code = " . $e->getCode() . " and message = " . $e->getMessage() . "\n";
  } 
