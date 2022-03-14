<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";
include "TranslateAPIWrapper.php";

class Translator implements Translate {

   private $trans; 

   //public function __construct(\SimplXMLElement $el) // XML translation service section
   static public function create__translator(\SimplXMLElement $el) // TODO: Add returns type of Translator. 
   {
       // Create the Derived Translator classes that use Guzzle
       switch($el->name) { 

         case 'I':
           $trans = new IbmXXXTranslator($el);
           break;

        case 'M':
           $trans = new MSTranlator($el);
           break;        case 'M':

           $trans = new DeeplTranslate($el);
           break;
       }
       return $trans;
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
 
   public function translate(string $text, string $source_lang, string $target_lang) // TODO: Return what type of object 
   {
       $trans->prepare_request($text,  $source_lang,  $target_lang);

       $trans->send_request(); 

       $trans->get_sentences(); // generic response object or iterator?
   }
}
