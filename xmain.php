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


  check_args($argc, $argv);

  try {
   
    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    $webpage = new WebpageCreator(RestClient::createRestClient(ClassID::Leipzig), RestClient::createRestClient(ClassID::Azure),  RestClient::createRestClient(ClassID::Systran), "DE", "EN", "output-test");

    $webpage($file);

    //create_html_output(RestClient::createRestClient(ClassID::Leipzig), RestClient::createRestClient(ClassID::Azure),  RestClient::createRestClient(ClassID::Systran), "output.html");
 
  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
