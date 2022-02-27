<?php

include "config.php";
include "SentenceFetcher.php";
include "DeeplTranslator.php";

$fetcher = new SentenceFetcher($config['leipzip']['corpus']);

$tr = new DeeplTranslator($config['deepl']['apikey']);

foreach ($file as $word) {

   $sents = $fetcher->fetch();

   foreach($sents as $german)	
	   $english = $tr->translate($german,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);

   // Write line of .html file
}
