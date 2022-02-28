<?php
use \SplFileObject as File;

include "config.php";
include "UnivLeipzigSentenceFetcher.php";
include "DeeplTranslator.php";

 $fetcher = new UnivLeipzigSentenceFetcher($config['leipzig']['corpus']);

 $trans = new DeeplTranslator($config['deepl']['apikey']);

 $file =  new File($config['leipzig']['input_file'], "r");

 $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

 foreach ($file as $de_word) {

    try {
        
     $rc = $fetcher->get_sentences($de_word);
    
     echo "Response Return Code: $rc:\n";

   } catch (Exception $e) {

      echo "Exception: code = " . $e->getCode() . "\n";  
      echo "Exception: message = " . $e->getMessage() . "\n";
   }
 }
