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

   // Called by base Translator::translate method 
   final function extract_translation(Response $response) : string
   {
       $contents = $response->getBody()->getContents();

       $obj = json_decode($contents);

       return $obj[0]->translations[0]->text; 
   } 

   // Called by base Translator::translate method 
   final protected function add_text(string $text)
   {
      $this->setJson( [['Text' => $text]] );       
   }

   // Azure Translator offers dictionary lookup service, too.
   final public function dict_lookup(string $word, string $src_lang, string $dest_lang) 
   {
      // 1. Set the dictionary languages
      $this->setLanguages($dest_lang, $src_lang); 
       
      // 2. Add the json input
      // Uses the same query settings found in config.xml: api-version, from, to 
      // Question is 'Content-Length'header required?
      $this->setJson( [['Text' => $word]] );

      // 3. Issue post request 
      $response = $this->post(self::$dict_route);

      $contents = $response->getBody()->getContents();

      $obj = json_decode($contents)[0]; 

      return $obj->translations[0]->displayTarget;
   }
}
