#!/usr/bin/env php
<?php
declare(strict_types=1);
use Translators\Translator;

include "SentenceFetcher.php";

include "WebPageCreator.php";
include "FileReader.php";

  if ($argc < 2) {
  
      echo "Enter name of translation service (i for IBM, m for Microsoft or d for DEEPL), and the name of the output HTML file (omit .html)\n";
      return;
  }


  $rc = check_args($argv);

  $xml = \simplexml_load_file("config.xml");

  $trans = Translator::createfromXML($xml, "m"); // <-- Translator::createfromXML($xml, $argv[1]); 

  $fetcher = new SentenceFetcher($xml); 

  $creator = new WebPageCreator("new");// $argv[1]); 

  $file =  new FileReader($argv[0]);
 
  try {

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
