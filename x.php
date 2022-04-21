<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\WebpageCreator;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\PonsDictionary;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

function check_args(int $argc, array $argv)
{
  if ($argc < 2)
      die ("Enter file with the list of words.\n");

  if (!file_exists($argv[1]))
       die("Input file " . $argv[1] . " does not exist!\n");

  if (!file_exists("config.xml"))
       die("config.xml not found in current directory.\n");
}

function create_html_output(SentenceFetchInterface $fetcher, TranslateInterface $translator, File $file)
{ 
   $creator = new WebpageCreator();
  
   foreach ($file as $word) {
  
      $creator->write("<strong>$word</strong>", "<strong>No Definitions (yet)</strong>"); 

      echo "Fetching '$word' examples:\n";

      foreach ( $fetcher->fetch($word, 3) as $sentence) {

           echo "Translation of: " . $sentence . "\n";

           // 2nd parameter is destination language. 3rd parameter is optional source language.
           // If 3rd parameter is ommited, source language is automatically detected.
           $translation = $translator->translate($sentence, "EN-US", "DE"); 
           
           echo "is: " . $translation . "\n";
           
           $creator->write($sentence, $translation); 
      }
      echo "\n";
   }
}

function pons_output(PonsDictionary $dict, File $file)
{
   foreach ($file as $word) {
  
        $iter = $dict->lookup($word, "DE", "EN"); 
           
        foreach($iter as $result) {
               
            echo $result . "\n";
        }
        
        echo "\n=============\n";
    }
}

  check_args($argc, $argv);

  try {
  
    $fetcher = RestClient::createRestClient(ClassID::Leipzig); 

    $translator = RestClient::createRestClient(ClassID::Azure); 
    
    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    //create_html_output($fetcher, $translator, $file);
    
    $dict = RestClient::createRestClient(ClassID::Pons);
    
    pons_output($dict, $file);

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
