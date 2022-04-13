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
  
  $r = $fetcher->fetch("Anlagen", 3);

  $creator = new WebPageCreator("new");// $argv[1]); 

  $file =  new FileReader($config['leipzig']['input_file']);
 
  try {

    foreach ($file as $de) {
   
       $creator->write("<strong>$de</strong>", "&nbsp;"); 

       /* 
         SentenceInformation (is an object) containing:
   
           1. id
           2. sentence - the actual string text of the sample sentence
           3. source - of type SourceInformation 
        */
      
       $sentenceInfo_objs = $fetcher->fetch($de); // todo: Retirn Iterator? IteratorIterator?
         
       foreach ($sentenceInfo_objs as $sentenceInfo_obj) {
   
            $de_sentence = $sentenceInfo_obj->sentence;

            $translations = $trans->translate($de_sentence,  $src_lang, $target_lang);
            
            $creator->write($de_sentence, $translations[0]->text); // <-- todo: Get rid of '[0]' and invent a general return type.
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
