<?php
declare(strict_types=1);
use Translators\Translator;

include "SentenceFetcher.php";

include "WebPageCreator.php";
include "FileReader.php";

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
  
    $trans = Translator::createfromXML($xml, "m"); // <-- Translator::createfromXML($xml, $argv[1]); 
  
    $fetcher = new SentenceFetcher($xml); 
  
    $creator = new WebPageCreator("new"); //todo: Create this with a unique, time-stamped name.
  
    $file =  new FileReader($argv[0]);
   
    foreach ($file as $word) {
   
       $creator->write("<strong>$de</strong>", "&nbsp;"); 

       foreach ( $fetcher->fetch($word, 3) as $sentence) {

            echo $sentence . "\n";

            $translation = $trans->translate($sentence,  "DE", "EN-US");
            
            $creator->write($de_sentence, $translation); 
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
