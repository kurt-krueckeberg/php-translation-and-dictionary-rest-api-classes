<?php

include "config.php";
include "LeipzigSentenceFetcher.php";
include "FileReader.php";

 $fetcher = new LeipzigSentenceFetcher($config['leipzig']['corpus']);

 $file =  new FileReader($config['leipzig']['input_file']);
 
 try {

    foreach ($file as $de_word) {

       echo "Word = $de_word\n";   

       $sentenceInfo_objs = $fetcher->get_sentences($de_word);
       var_dump( $sentenceInfo_objs);
       continue;
      /* 
         SentenceInformation (is an object) containing:
   
            1. id
            2. sentence - the actual string text of the sample sentence
            3. source - of type SourceInformation 
       */
          
       foreach ($sentenceInfo_objs as $sentenceInfo_obj) {
   
            $de_sentence = $sentenceInfo_obj->sentence;

            echo "Leipzig Sample Sentence: $de_sentence\n";
       }
    }

  } catch (Exception $e) {

       echo "Exception: message = " . $e->getMessage() . "\n";
  } 
