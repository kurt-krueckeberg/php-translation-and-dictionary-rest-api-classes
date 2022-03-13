<?php
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "TranslateInterface.php";

abstract class Translator implements TranslateInterface {
    
   private $guzzle; // strategy.

   protected function create_guzzle(\SimplXMLElement $el) {}

   public function __construct(\SimplXMLElement $el) // XML translation service section
   {
       $this->guzzle = create_guzzle($el);
   }

   /*
     translate() returns an array of translated sentences, in which each element has two properties:
      1. The detected_source_language - which, of course, we required to specified, so there is nothing to 'detect'.
      2. "text" - the translated text in teh target lanauge.
     Client code can iterate over this array like this:
       $translations = $tr->translate($input_sentence, $source_lang, $target_lang);
            
       foreach($translations as $translation) {
 
           do_something($de_sentence, $translation->text);
       } 
   */
 
   public function translate(string $text, string $source_lang, string $target_lang) : Translat
   {
       $this->prepare_request(string $text, string $source_lang, string $target_lang);

       $this->request(); 

       $this->get_reponse(); // generic response object or iterator?
   }
}
