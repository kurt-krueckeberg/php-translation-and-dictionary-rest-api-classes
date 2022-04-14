#!/usr/bin/env php
<?php
declare(strict_types=1);
use Translators\Translator;

include "SentenceFetcher.php";

include "WebPageCreator.php";
include "FileReader.php";

function check_args(array $argv)
{
  if (strlen($argv[0]) !== 1 || $argv[0] !== 'd' ||  $argv[0] !== 'm' ||  $argv[0] !== 'i')
        throw new \Exception("First argument must be 'd', 'm' or 'i'");

  if (substr($argv[1], strpos($argv[1], ".")) !== "xml")
        throw new \Exception("2nd argument must be config.xml file");

}
  if ($argc < 2) {
  
      echo "Enter name of translation service (i for IBM, m for Microsoft or d for DEEPL), and the name of the output HTML file (omit .html)\n";
      return;
  }

  $rc = check_args($argv);

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
