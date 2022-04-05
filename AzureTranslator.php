<?php
declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

require 'vendor/autoload.php';

require_once "Translator.php";

class AzureTranslator extends Translator {

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

   public function __construct(SimpleXMLElement $provider)
   {
         parent::__construct($provider);     
   }     

   // Overriden by derived classes to do any special handling
   final function process_response(Response $response) : string
   {
      return ""; // todo: implement
   } 



    // todo: break this into the three methods -- prepare_trans_request(), send_trans_request and get_sentences()
    final protected function prepare_json_input(string $text) : string
    {
          return json_encode([ [ 'Text' => $text ] ]);  // <-- todo: urlencode($text)?           
   }
}
