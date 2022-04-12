<?php
declare(strict_types=1);
namespace Translators;

use GuzzleHttp\Psr7\Response;

class AzureTranslator extends Translator {

   static private string $dict_route = "dictionary/lookup";

    // Azure Translator REST calls can also accept a GUID
   static private function com_create_guid() 
   {
       return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
           mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
           mt_rand( 0, 0xffff ),
           mt_rand( 0, 0x0fff ) | 0x4000,
           mt_rand( 0, 0x3fff ) | 0x8000,
           mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
   }

   public function __construct(\SimpleXMLElement $provider)
   {
        parent::__construct($provider);     
   }     

   final function extract_translation(Response $response) : string
   {
       $contents = $response->getBody()->getContents();

       $obj = json_decode($contents);

       return $obj[0]->translations[0]->text; 
   } 
 
   final protected function add_text(string $text)
   {
      $this->setJson( [['Text' => $text]] );       
   }

   final public function dict_lookup(string $word, string $to_lang) // todo: Add: dest language
   {
      // Uses the same query settings found in config.xml: api-version, from, to 
      // Question is 'Content-Length'header required?
      $this->add_text($word);

      // tod: How to add to query parameter a different destination language, say: 'to' => 'EN-US' 
      $response = $this->post(self::$dict_lookup);

      var_dump($response);
   }
}
