#!/usr/bin/env php
<?php

include "config.php";
include "LeipzigSentenceFetcher.php";
include "DeeplTranslator.php";
include "WebPageCreator.php";
include "FileReader.php";

  if ($argc < 2) {
  
      echo "Enter name of the output .html file\n";
      return;
  }

 $fetcher = new LeipzigSentenceFetcher($config['leipzig']['corpus']);

 $tr = new DeeplTranslator($config['deepl']['apikey']);

 $creator = new WebPageCreator($argv[1]); 

 $file =  new FileReader($config['leipzig']['input_file']);
 
 try {

    foreach ($file as $de) {
   
       /*
         Deepl's translation API doesn't do dictionary translations of words. So there is no Englis 
         translation for the German word.
        */

       $creator->write("<strong>$de</strong>", "&nbsp;"); 
   
       $sentInfoObjs = $fetcher->get_sentences($de);
      
      /* 
        SentenceInformation (is an object) containing:
   
           1. id
           2. sentence - the actual string text of the sample sentence
           3. source - of type SourceInformation 
       */
          
       foreach ($sentInfoObjs as $sentenceInfoObject) {
   
            $de_sentence = $sentenceInfoObject->sentence;

            $translations = $tr->translate($de_sentence,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);
            
            $creator->write($de_sentence, $translations[0]->text);
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
