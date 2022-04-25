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


  try {
    check_args($argc, $argv);

    $translator = RestClient::createRestClient(ClassID::Azure); 
    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

   $pons = RestClient::createRestClient(ClassID::Pons); 


   foreach($file as $word) {
       
     echo  "Definition of $word is: ";
     
     print_r(  $pons->lookup($word, "DE", "EN") );
     
     echo  "\n"; 
   }
    

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
