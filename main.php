<?php

include "config.php";
include "SentenceFetcher.php";
include "DeeplTranslator.php";
include "HtmlWriter.php";

if ($argc < 2) {

    echo "Enter name of the output .html file\n";
    return;
}

$fetcher = new SentenceFetcher($config['leipzip']['corpus']);

$tr = new DeeplTranslator($config['deepl']['apikey']);

$writer = new HtmlWriter($argv[1] . ".html");

 $file =  new SplFileObject($config['leipzip']['input_file'], "r");

 $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

foreach ($file as $word) {

   $sents = $fetcher->fetch();

   foreach($sents as $german) {

	$english = $tr->translate($german,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);
      
        $writer->write($german, $english); 
   }

   // Write line of .html file
}
