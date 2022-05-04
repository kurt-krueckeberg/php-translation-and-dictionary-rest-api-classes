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

function write_definitions(WebPageCreator $creator, string |array|LanguageTools\ResultsIterator $defns)
{
    echo "Definition(s):\n";

    if (is_string($defns)) { 

        echo $defns . "\n";

        $creator->write("&nbsp;", $defns); 

    } else {  // definitions are iterable and are stdClass objects with two members:
              // source and target. target has the actual definition. 

        foreach ($defns as $def) {

            echo "$def->target \n";

            $creator->write("&nbsp;", $defn->target); 
        }
    }
}

/*
 * PHP 8.1 required: The 2nd parameter type is the intersection of two interface types. 
 */
function create_html_output(SentenceFetchInterface $fetcher, LanguageTools\TranslateInterface & LanguageTools\DictionaryInterface $translator, File $file, string $fname)
{ 
   $creator = new WebpageCreator($fname);
  
   foreach ($file as $word) {
  
      $creator->write("<strong>$word</strong>", "<strong>Definitions:</strong>"); 

      echo "Fetching '$word' examples:\n";

      // Get definitions 
      $defns =  $translator->lookup($word, "DE", "EN");

      // If the definition is just a one-word string, it is not iterable.
      write_definitions($creator, $defns);

      // Fetch sentences and translate them.          
      foreach ( $fetcher->fetch($word, 3) as $sentence) {

           echo "Translation of: " . $sentence . "\n";

           // The 2nd parameter is destination language. iThe 3rd parameter is the optional
           //  source language (if it is ommitted, the source language is automatically detected).
           $translation = $translator->translate($sentence, "EN", "DE"); 
           
           echo "is: " . $translation . "\n";
           
           $creator->write($sentence, $translation); 
      }
      echo "\n";
   }
}

function display_defn(ResultsIterator $iter, string $word)
{ 
   "\nDefinitions for $word:\n";
 
   foreach ($iter as $result) {
        
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


function create_txt_output(SentenceFetchInterface $fetcher, LanguageTools\TranslateInterface $translator, LanguageTools\DictionaryInterface $dict, File $file)
{
  foreach ($file as $word) {
  
      $resultsIter = $dict->lookup($word, "DE", "EN");

      display_defn($resultsIter, $word);

      // Fetch sentences and translate them.          
      foreach ( $fetcher->fetch($word, 3) as $sentence) {

           echo "Translation of: " . $sentence . "\n";

           // The 2nd parameter is destination language. iThe 3rd parameter is the optional
           //  source language (if it is ommitted, the source language is automatically detected).
           $translation = $translator->translate($sentence, "EN", "DE"); 
           
           echo "is: " . $translation . "\n";
      }
      echo "\n";
   }

}
  check_args($argc, $argv);

  try {
   
    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    create_txt_output(RestClient::createRestClient(ClassID::Leipzig), RestClient::createRestClient(ClassID::Azure),  RestClient::createRestClient(ClassID::Systran), $file);

    //create_html_output(RestClient::createRestClient(ClassID::Leipzig), RestClient::createRestClient(ClassID::Azure),  RestClient::createRestClient(ClassID::Systran), "output.html");
 
  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
