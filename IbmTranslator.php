<?php
declare(strict_types=1);
use GuzzleHttp\Client;
use GuzzleHttp\Request;

require 'vendor/autoload.php';

class IbmTranslator extends Translator {
    
   public function __construct(SimpleXMLElelement $provider) 
   {

      parent::__construct($provider);
   }

   protected function prepare_request(Request $requst, string $text)
   {
   }
}
