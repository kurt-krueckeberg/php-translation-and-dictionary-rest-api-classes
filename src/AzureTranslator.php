<?php
declare(strict_types=1);
namespace Translators;

use GuzzleHttp\Psr7\Response;

class AzureTranslator extends Translator {

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

   // Overriden by derived classes to do any special handling
   final function process_response(Response $response) : string
   {
       $contents = $response->getBody()->getContents();

       $obj = json_decode($contents);

       return $obj[0]->translations[0]->text; 
   } 
 
   final  protected function prepare_input(string $text) :  array
   {
      return [['Text' => $text]];       
   }
}
