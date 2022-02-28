<?php
use \SplFileObject as File;
include "config.php";
include "SentenceFetcher.php";
include "DeeplTranslator.php";
include "HtmlPageCreator.php";

  if ($argc < 2) {
  
      echo "Enter name of the output .html file\n";
      return;
  }

 $fetcher = new SentenceFetcher($config['leipzig']['corpus']);

 $tr = new DeeplTranslator($config['deepl']['apikey']);

 $writer = new HtmlPageCreator($argv[1]); 

 $file =  new File($config['leipzip']['input_file'], "r");

 $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

 foreach ($file as $word) {

	 // 1. Translate the word 
	 //
    //todo: Parse the sentence results
    $sents = $fetcher->get($word);
 
    foreach($sents as $german) {
 
         $english = $tr->translate($german,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);
 
    //todo: Parse the translation results
         
      //todo: write the german word itself and its english translation
         $writer->write($german, $english); 
    }
 
    // Write line of .html file
 }
