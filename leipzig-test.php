<?php
use \SplFileObject as File;

include "config.php";
include "LeipzigSentenceFetcher.php";

 $fetcher = new LeipzigSentenceFetcher($config['leipzig']['corpus']);

 $file =  new File($config['leipzig']['input_file'], "r");

 $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
 
 try {

    foreach ($file as $de_word) {
   
       $sentenceInfoObjs_array= $fetcher->get_sentences($de_word);
      
      /* 
         SentenceInformation (is an object) containing:
   
            1. id
            2. sentence - the actual string text of the sample sentence
            3. source - of type SourceInformation 
       */
          
       foreach ($sentenceInfoObjs_array as $sentenceInfoObject) {
   
            $de_sentence = $sentenceInfoObject->sentence;

            echo "Leipzig Sample Sentence: $de_sentence\n";
       }
    }

  } catch (Exception $e) {

       echo "Exception: message = " . $e->getMessage() . "\n";
  } 
