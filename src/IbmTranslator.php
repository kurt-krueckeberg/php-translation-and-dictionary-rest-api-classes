<?php
declare(strict_types=1);
namespace Translators;

require 'vendor/autoload.php';

class IbmTranslator extends Translator {
    
   public function __construct(\SimpleXMLElelement $provider) 
   {
      parent::__construct($provider);
   }

   protected function prepare_json_input(string $text) : string
   {
   }
}
