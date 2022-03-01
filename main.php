<?php
use \SplFileObject as File;

include "config.php";
include "LeipzigSentenceFetcher.php";
include "DeeplTranslator.php";
include "HtmlPageCreator.php";

  if ($argc < 2) {
  
      echo "Enter name of the output .html file\n";
      return;
  }

 $fetcher = new LeipzigSentenceFetcher($config['leipzig']['corpus']);

 $tr = new DeeplTranslator($config['deepl']['apikey']);

 $creator = new HtmlPageCreator($argv[1]); 

 $file =  new File($config['leipzig']['input_file'], "r");

 $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
 
 try {

    foreach ($file as $de_word) {
   
       /*
         Note: Deepl's Free API doesn't do dictionary-like translations of single words. So there is no Englis 
         translation fothe German word.
        */

       $creator->write($de_word, "&nbsp;"); 
   
       $sentenceInfoObjs_array= $fetcher->get_sentences($de_word);
      
      /* 
         SentenceInformation (is an object) containing:
   
            1. id
            2. sentence - the actual string text of the sample sentence
            3. source - of type SourceInformation 
       */
          
       foreach ($sentenceInfoObjs_array as $sentenceInfoObject) {
   
            $de_sentence = $sentenceInfoObject->sentence;

            // TODO: Add HRML emphasis like so '<em>$dwe_word</em>' around the German word, so it is bolded.
        
            $translation = $tr->translate($de_sentence,  $config['deepl']['source_lang'], $config['deepl']['target_lang']);
            
            $creator->write($de_sentence, $translation[0]->text);
       }
    }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
