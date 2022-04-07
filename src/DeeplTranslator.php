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
     
   public function process_response(Response $response) : string
   {
      $contents = $response->getBody()->getContents();

      $obj = json_decode($contents);

      return urldecode($obj->translations[0]->text); // Return the string in the the first element of the translations array.
   }

   protected function add_input(string $text)
   {
      $this->setQueryParm('text', urlencode($text));
   }
}
