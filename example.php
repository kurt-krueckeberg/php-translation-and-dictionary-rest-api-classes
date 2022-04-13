#!/usr/bin/env php
<?php
declare(strict_types=1);
use Translators\Translator;

include "SentenceFetcher.php";

include "WebPageCreator.php";
include "FileReader.php";
/*
  if ($argc < 2) {
  
      echo "Enter name of translation service (i for IBM, m for Microsoft or d for DEEPL), and the name of the output HTML file (omit .html)\n";
      return;
  }
  */

  //$rc = check_args($argv);

  $xml = \simplexml_load_file("config.xml");

  $trans = Translator::createfromXML($xml, "m"); //$argv[1]); // Translator::createTranslator("config.xml", $argv[1])

  $fetcher = new SentenceFetcher($xml);
  
  // TODO: Add in FileReader that will open file with words to translate
  
  try {

    foreach ($file as $de) {
   
       $creator->write("<strong>$de</strong>", "&nbsp;"); 

       foreach ( $fetcher->fetch("Anlagen", 3) as $de_sentence) {

            echo $de_sentence . "\n";

            $translation = $trans->translate($de_sentence,  $src_lang, $target_lang);
            
            $creator->write($de_sentence, $translation); 
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
