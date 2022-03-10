#!/usr/bin/env php
<?php

include "leipzig-config.php";
include "deepl-config.php";
include "LeipzigSentenceFetcher.php";
include "DeeplTranslator.php";
include "WebPageCreator.php";
include "FileReader.php";

  if ($argc < 2) {
  
      echo "Enter name of the output .html file\n";
      return;
  }
  
  $trans = create_translator($translators, $config['translator');

  $src_lang = $settings 
  $target_lang = 

  $fetcher = new LeipzigSentenceFetcher($config['leipzig']['corpus']);

 //--$tr = new DeeplTranslator($config['deepl']['apikey']);

 $creator = new WebPageCreator($argv[1]); 

 $file =  new FileReader($config['leipzig']['input_file']);
 
 try {

    foreach ($file as $de) {
   
      // TODO: Look up word in my dictionary database rom
   
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
            
            $creator->write($de_sentence, $translations[0]->text);
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
