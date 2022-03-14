<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "Translate.php";
include "GuzzleTranslateAPIWrapper.php";

class Translator implements Translate {

   private $api_impl; 

   public function __construct(string $fxml, string $service) 
   {
      $this->api_iml = GuzzleTranslateAPIWarpper::create_implementor($xml_fname, $service);
   }

   public function translate(string $text, string $source_lang, string $target_lang) // TODO: Return what type of sentences object should be returned?
   {
       $api_impl->prepare_trans_request($text,  $source_lang,  $target_lang);

       $api_impl->send_trans_request(); 

       return $api_impl->get_sentences(); // generic response object or iterator?
   }
}
