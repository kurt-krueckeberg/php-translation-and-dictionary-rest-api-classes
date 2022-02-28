<?php

include "config.php";
include "SentenceFetcher.php";

 $fetcher = new SentenceFetcher($config['leipzig']['corpus']);

 foreach ($file as $de_word) {

    // 1. Translate the word itself
    $en_word = $tr->translate($de_word,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);

    echo "German Word = $de_word. Englis Translation = $en_word\n";

    //todo: Parse the sentence results
    $sents = $fetcher->get($de_word);
    
    echo "Sample Sentences:\n";

    print_r($sents);
 }
