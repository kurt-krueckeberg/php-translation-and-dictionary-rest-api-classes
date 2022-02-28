<?php
use \SplFileObject as File;
include "config.php";
include "UnivLeipzigSentenceFetcher.php";
include "DeeplTranslator.php";
include "HtmlPageCreator.php";

  if ($argc < 2) {
  
      echo "Enter name of the output .html file\n";
      return;
  }

 $fetcher = new UnivLeipzigSentenceFetcher($config['leipzig']['corpus']);

 $tr = new DeeplTranslator($config['deepl']['apikey']);

 $creator = new HtmlPageCreator($argv[1]); 

 $file =  new File($config['leipzig']['input_file'], "r");

 $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
 
 try {

    foreach ($file as $de_word) {
   
       // 1. Translate the word itself
       //++$en_word = $tr->translate($de_word,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);
       
       // todo: parse/handle-correctly the result above in $en_word.
    
       //++$creator->write($de_word, $en_word); 
   
       $sentenceInfoObjs_array= $fetcher->get_sentences($de_word);
      
      /* 
         SentenceInformation (is an object) containing:
   
            1. id
            2. sentence - the actual string text of the sample sentence
            3. source - of type SourceInformation 
       */
          
       foreach ($sentenceInfoObjs_array as $sentenceInfoObject) {
   
            $de_sentence = $sentenceInfoObject->sentence;
        
            //++$en_sentence = $tr->translate($de_sentence,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);
            
            //++$creator->write($de_sentence, $english); //<-- todo: correct 2nd param.
       }
    }

  } catch (Exception $e) {
         echo "Exception: code = " . $e->getCode() . "\n";  
         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
