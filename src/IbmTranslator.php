<?php
declare(strict_types=1);
namespace Translators;

class IbmTranslator extends Translator {
    
   public function __construct(\SimpleXMLElelement $provider) 
   {
      parent::__construct($provider);
   }

   protected function add_text(string $text, array $options)
   {
   }
}
