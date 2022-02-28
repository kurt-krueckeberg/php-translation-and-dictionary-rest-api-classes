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


    $sents = $fetcher->get($de_word);
    
    echo "Sample Sentences:\n";

    $obj = json_decode($sents);

    var_dump($obj->sentences);

    //var_dump(json_decode(sents, true));
 }
