<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\WebpageCreator;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\DictionaryInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\ResultsIterator;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

function check_args(int $argc, array $argv)
{
  if ($argc < 2)
      die ("Enter file with the list of words follow by the name of the output html file (omitting the .html extension).\n");

  if (!file_exists($argv[1]))
       die("Input file " . $argv[1] . " does not exist!\n");
  
}
/*
 Systran.net's Translator provides:
 1. translation
 2. dictionary lookup
 */

function display_systran_definitions_and_expressions(ResultsIterator $iter, string $word)
{ 
   if (count($iter) == 0) {
      echo "no definitions available for '$word'.\n";
      return;
   }
 
   echo "Definitions for '$word':\n";

   foreach ($iter as $result) {

       // Show which term is being defined and its part-of-speech (pos).        
       echo "\tTerm:  $result->term [$result->pos]\n";

       echo "\tMeanings:\n";
       
       // Definitions can  have example expressions.
       foreach($result->definitions as $index => $definition) {
           
           $i = $index + 1;
           
           echo "\t$i. {$definition['meaning']}\n";

           if (count($definition['expressions']) != 0)
               echo "\t\tExpressions:\n";

           foreach ($definition['expressions'] as $key => $expression) {
               
               $i = $key + 1;
               echo "\t\t$i. $expression->source [$expression->target]\n";
           }
       }
       echo "\n";
  }
  echo "\n";
}

/*
 Microsoft's Azure Translator provide:
 1. translation
 2. dictionary lookup
 3. example sentences based on a dfiinition
 */
function azure_definitions_and_examples(File $file)
{
  $trans = RestClient::createRestClient(ClassID::Azure);

  $file->rewind();

  foreach ($file as $word) {
  
      $outer_iter = $trans->lookup($word, "DE", "EN");
      
      echo "Number of definitions for '$word' is " . count($outer_iter) . "\n";
      
      foreach($outer_iter as $key => $r) {

           $defn = $r->normalizedTarget;

           echo "Definition #" . $key + 1 . " for '$word': '$defn'\n";
           
           $iter = $trans->examples($word, $outer_iter);
           
           echo "Number of examples with this definition is " . count($iter) . "\n";

           foreach($iter as $example) {
               
               foreach($example as $sentence)  {
                  echo "{$sentence['source']}\n";   
                  echo "{$sentence['target']}\n";   
               }     
           }    
      } 
  }
}
/*
 Systran Translator provides:
 1. translation
 2. dictionary lookup
 */
function systran_definitions_and_expressions(File $file)
{
  $trans = RestClient::createRestClient(ClassID::Systran);

  $file->rewind();

  foreach ($file as $word) {
  
      $iter = $trans->lookup($word, "DE", "EN");

      display_systran_definitions_and_expressions($iter, $word);
  }
}
/*
 Univ. of Leipzig sentence corpora REST API
 offers an example sentences service. 
*/

function  leipzig_sentences_with_transations($file)
{
  $fetcher = RestClient::createRestClient(ClassID::Leipzig);
  $trans = RestClient::createRestClient(ClassID::Azure);

  $file->rewind();

  foreach ($file as $word) {

      echo "Example sentences for word '$word':\n";  

      $sentences_iter = $fetcher->fetch($word, 3);

      foreach($sentences_iter as $sentence) {

           echo "Target sentence: $sentence\n"; 

           $t = $trans->translate($sentence, "DE", "EN"); 

           echo "Target translation: $sentence $t\n"; 
      }
  }
}

function display_sentences(ResultsIterator $iter, string $word, TranslateInterface $trans)
{
  echo "Example sentences for '$word':\n\n"; 

  foreach ($iter as $sentence) {

        $translation = $trans->translate($sentence, "EN", "DE"); 
        
        echo "$sentence \n$translation\n\n";
  }
}


  check_args($argc, $argv);

  try {
   
    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    azure_definitions_and_examples($file);
 
    systran_definitions_and_expressions($file);

    leipzig_sentences_with_transations($file);
 
  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
