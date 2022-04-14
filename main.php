<?php
declare(strict_types=1);
use \SplFileObject as File;
use Translators\Translator;

include "SentenceFetcher.php";
include "WebPageCreator.php";

function check_args(int $argc, array $argv)
{
  if ($argc < 2)
      die ("Enter file with the list of words.\n");

  if (!file_exists($argv[1]))
       die("Input file " . $argv[1] . " does not exist!\n");

  if (!file_exists("config.xml"))
       die("config.xml not found in current directory.\n");
}

function create_output(\SimpleXMLElement $xml, string  $fname)
{ 
   $fetcher = new SentenceFetcher($xml); 
  
   $creator = new WebPageCreator();
  
   $file =  new File($fname);

   $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

   $translator = Translator::createfromXML($xml, "m"); 

   foreach ($file as $word) {
  
      $creator->write("<strong>$word</strong>", "<strong>No Definitions (yet)</strong>"); 

      echo "Fetching '$word' examples:\n";

      foreach ( $fetcher->fetch($word, 3) as $sentence) {

           echo "Translating: " . $sentence . "\n";

           // 2nd parameter is destination language. 3rd parameter is optional source language.
           // If 3rd parameter is ommited, source language is automatically detected.
           $translation = $trans->translate($sentence, "EN-US", "DE"); 
           
           $creator->write($sentence, $translation); 
      }
      echo "\n";
   }
}

  check_args($argc, $argv);

  try {

    $xml = \simplexml_load_file("config.xml");
  
    create_output($xml, $argv[1]);

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
