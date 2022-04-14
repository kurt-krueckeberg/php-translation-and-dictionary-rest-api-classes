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
       die("The input file does not exist!\n");

  if (!file_exists("config.xml"))
       die("config.xml not found in current directory.\n");
}

  check_args($argc, $argv);

  try {

    $xml = \simplexml_load_file("config.xml");
  
    $fetcher = new SentenceFetcher($xml); 
  
    $creator = new WebPageCreator();
  
    $file =  new File($argv[1]);

    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    $trans = Translator::createfromXML($xml, "m"); 
  
    foreach ($file as $word) {
   
       $creator->write("<strong>$word</strong>", "&nbsp;"); 

       foreach ( $fetcher->fetch($word, 3) as $sentence) {

            echo "Translating: " . $sentence . "\n";

            // 2nd parameter is destination language. 3rd parameter is optional source language.
            // If 3rd parameter is ommited, source language is automatically detected.
            $translation = $trans->translate($sentence, "EN-US", "DE"); 
            
            $creator->write($sentence, $translation); 
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
