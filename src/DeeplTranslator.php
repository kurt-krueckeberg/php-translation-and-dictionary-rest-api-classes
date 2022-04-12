<?php
declare(strict_types=1);
namespace Translators;
use GuzzleHttp\Psr7\Response;

// See documentation in Deepl-doc.md 
class DeeplTranslator extends Translator {

   public function __construct(\SimpleXMLElement $provider) 
   {
       parent::__construct($provider); 
   }

   // Overriden to return the string in the the first element of the translations array. 
   // Called by base Translator::translate method 
   public function extract_translation(Response $response) : string
   {
      $contents = $response->getBody()->getContents();

      $obj = json_decode($contents);

      return urldecode($obj->translations[0]->text); 
   }

   // Overriden to add input to send with request
   // Called by base Translator::translate method 
   protected function add_text(string $text)
   {
      $this->setQueryParm('text', urlencode($text));
   }
}
