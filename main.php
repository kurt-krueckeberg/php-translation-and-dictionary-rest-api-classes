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

function display_sentences(ResultsIterator $iter, string $word, TranslateInterface $trans)
{
  echo "Example sentences for '$word':\n\n"; 

  foreach ($iter as $sentence) {

        $translation = $trans->translate($sentence, "EN", "DE"); 
        
        echo "$sentence \n$translation\n\n";
  }
}

function display_systran_definitions(ResultsIterator $iter, string $word)
{ 
   if (count($iter) == 0) {
      echo "no definitions available for '$word'.\n";
      return;
   }
 
   echo "Definitions for '$word':\n";

   foreach ($iter as $result) {
        
       echo "\tTerm:  $result->term [$result->pos]\n";

       echo "\tMeanings:\n";

       foreach($result->definitions as $index => $definition) {
           
           $i = $index + 1;
           
           echo "\t$i. $definition->meaning\n";

           if (count($definition->expressions) != 0)
               echo "\t\tExpressions:\n";

           foreach ($definition->expressions as $key => $expression) {
               
               $i = $key + 1;
               
               //echo "\t\t$i. $expression->source\n";
               echo "\t\t$i. $expression->source [$expression->target]\n";
           }
       }
       echo "\n";
  }
  echo "\n";
}

function create_txt_output(SentenceFetchInterface $fetcher, LanguageTools\TranslateInterface $trans, LanguageTools\DictionaryInterface $dict, File $file)
{
  foreach ($file as $word) {
  
      $resultsIter = $dict->lookup($word, "DE", "EN");

      display_defn($resultsIter, $word);

      $sentIter = $fetcher->fetch($word, 3);

      display_sentences($sentIter, $word, $trans);
  }
}
/*
 Mrircorsoft's Azure Translator provide:
 1. translation
 2. dictionary lookup
 3. example sentences based on a dfiinition
 */
function azure_definitions_and_examples(File $file)
{
  $trans = RestClient::createRestClient(ClassID::Azure);

  $file->rewind();

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
/*
 Systran Translator provides:
 1. translation
 2. dictionary lookup
 */
function systran_definitions(File $file)
{
  $trans = RestClient::createRestClient(ClassID::Systran);

  $file->rewind();

  foreach ($file as $word) {
  
      $iter = $trans->lookup($word, "DE", "EN");

      display_systran_definitions($iter, $word);
  }
}


  check_args($argc, $argv);

  try {
   
    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    azure_definitions_and_examples($file);
 
    systran_definitions($file);

    //leipzig_sentences($file);

/*
    leipzig_sentences($file);

    create_txt_output(RestClient::createRestClient(ClassID::Leipzig), RestClient::createRestClient(ClassID::Azure),  RestClient::createRestClient(ClassID::Systran), $file);
 */
 
  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
