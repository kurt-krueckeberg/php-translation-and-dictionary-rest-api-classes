<?php
use \SplFileObject as File;

include "config.php";
include "SentenceFetcher.php";
include "DeeplTranslator.php";

 $fetcher = new SentenceFetcher($config['leipzig']['corpus']);

 $trans = new DeeplTranslator($config['deepl']['apikey']);

 $file =  new File($config['leipzig']['input_file'], "r");

 $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

 foreach ($file as $de_word) {


    $sents = $fetcher->get_sentences($de_word);
    
    echo "Sample Sentences:\n";

    $obj = json_decode($sents);

    var_dump($obj->sentences); 

   /* 
      The json object returned contains a SentencesList (instance), which has just two properties:

        1. count - integer
        2. sentences - is an array (I believe) of SentenceInformation elements
      
      SentenceInformation (is an object) containing:

         1. id
         2. sentence - the actual string text of the sample sentence
         3. source - of type SourceInformation 
    */
       
    foreach ($obj->sentences as $sentence_information) {

          $sentence = $sentence_information;

    }

 }
