#!/usr/bin/env php
<?php

include "leipzig-config.php";
include "deepl-config.php";
include "LeipzigSentenceFetcher.php";
include "Translator.php";
include "WebPageCreator.php";
include "FileReader.php";

  if ($argc < 2) {
  
      echo "Enter name of translation service (i for IBM, m for Microsoft or d for DEEPL), and the name of the output HTML file (omit .html)\n";
      return;
  }
  
  $rc = check_args($argv);

  $trans = new Translator("config.xml", $argv[1]);

  $fetcher = new LeipzigSentenceFetcher($config['leipzig']['corpus']);

  $creator = new WebPageCreator($argv[1]); 

  $file =  new FileReader($config['leipzig']['input_file']);
 
  try {

    foreach ($file as $de) {
   
       // TODO: MS Trnaslator Azure Service has a dictionary look up--IBM, too?
   
       $creator->write("<strong>$de</strong>", "&nbsp;"); 

       /* 
         SentenceInformation (is an object) containing:
   
           1. id
           2. sentence - the actual string text of the sample sentence
           3. source - of type SourceInformation 
        */
      
       $sentenceInfo_objs = $fetcher->get_sentences($de);
         
       foreach ($sentenceInfo_objs as $sentenceInfo_obj) {
   
            $de_sentence = $sentenceInfo_obj->sentence;

            $translations = $trans->translate($de_sentence,  $src_lang, $target_lang);
            
            $creator->write($de_sentence, $translations[0]->text); // <-- todo: Get rid of '[0]' and invent a general return type.
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
