<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";
include "GuzzleTranslateAPIWrapper.php";

class Translator implements Translate {

   private $api_impl; 

   //public function __construct(\SimplXMLElement $el) // XML translation service section
   public function __construct(string $fxml, string $service) // TODO: Add returns type of Translator. 
   {
      $this->api_iml = GuzzleTranslateAPIWarpper::create_implementor($xml_fname, $service);
   }

   /*
     Translate() returns an array of translated sentences, in which each element has two properties:

      1. The detected_source_language - which, of course, we required to specified, so there is nothing to 'detect'.
      2. "text" - the translated text in teh target lanauge.

     Client code can iterate over this array like this:
       $api_impllations = $tr->translate($input_sentence, $source_lang, $target_lang);
            
       foreach($api_impllations as $api_impllation) {
 
           do_something($de_sentence, $api_impllation->text);
       } 
   */
 
   public function translate(string $text, string $source_lang, string $target_lang) // TODO: Return what type of object 
   {
       $api_impl->prepare_trans_request($text,  $source_lang,  $target_lang);

       $api_impl->send_trans_request(); 

       return $api_impl->get_sentences(); // generic response object or iterator?
   }
}
