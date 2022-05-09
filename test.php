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

function azure_defns_And_examples(File $file, DictionaryInterface|TranslateInterface $trans)
{
  foreach ($file as $word) {
  
      echo "Definitions for '$word' :\n";
       
      $outer_iter = $trans->lookup($word, "DE", "EN");
      
      echo "\tNumber of definitions is " . count($outer_iter) . "\n";
      
      foreach($outer_iter as $r) {

           $defn = $r->normalizedTarget;

           echo "Examples for '$word' with deinitions of '$defn': \n";
      
           $iter = $trans->examples($word, $outer_iter);
           
           echo "\tNumber of examples is " . count($iter) . "\n";

           foreach($iter as $example) {
               
               foreach($example->sentences as $sentence)  {
                  echo "{$sentence['source']}\n";   
                  echo "{$sentence['target']}\n";   
               }     
           }    
      } 
  }
}

  try {

    $file =  new File("short-list.txt");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    azure_defns_And_examples($file);

  } catch (Exception $e) {

         echo "Exception: code = " . $e->getCode() . " and message = " . $e->getMessage() . "\n";
  } 
