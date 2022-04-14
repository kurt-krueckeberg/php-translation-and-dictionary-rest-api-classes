#!/usr/bin/env php
<?php
declare(strict_types=1);
use Translators\Translator;

include "SentenceFetcher.php";

include "WebPageCreator.php";
include "FileReader.php";

function check_args(int $argc, array $argv)
{
  if ($argc < 2) {
  
      die ("Enter name of translation service (i for IBM, m for Microsoft or d for DEEPL), and the name of the output HTML file (omit .html)\n");
      return;
  }

  if ( (strlen($argv[1]) !== 1) || ($argv[1] !== 'd' &&  $argv[1] !== 'm' && $argv[1] !== 'i' ) )
        die ("First argument must be 'd', 'm' or 'i'");

  if ($argv[2] !== "config.xml")
        die ("2nd argument must be config.xml file");
}


  check_args($argc, $argv);

  try {

    $xml = \simplexml_load_file("config.xml");
  
    $trans = Translator::createfromXML($xml, "m"); // <-- Translator::createfromXML($xml, $argv[0]); 
  
    $fetcher = new SentenceFetcher($xml); 
  
    $creator = new WebPageCreator("new"); // <--- WebPageCreator($argv[1]); 
  
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
