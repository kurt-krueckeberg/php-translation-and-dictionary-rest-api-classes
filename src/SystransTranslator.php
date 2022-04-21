<?php
declare(strict_types=1);
namespace LanguageTools;

// SeeDeepl-doc.md 
class SystransTranslator extends RestClient implements TranslateInterface, DictionaryInterface {
   
   static private array  $trans_route = array('method' => 'POST', 'route' => "?????????????");     
   static private array $lookup__route = array('method' => 'GET', 'route' => "?????????????");     

   static private string $from_key = "????"; 
   static private string $to_key = "????";  

   private $query = array();
   private $headers = array();
 
   public function __construct(\SimpleXMLElement $provider, Systransconfig  $c) 
   {
      parent::__construct($c);

      $this->headers = [ ((string) $provider->settings->credentials->header['name']) => (string) $provider->settings->credentials->header]; 
   }

   // If this is a translation request and there is no source language, the source langauge will be auto-detected.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from_key] = $source_lang; 

      $this->query[self::$to_key] = $dest_lang; 
   }

   final public function getTranslationLanguages() : array
   {
       $contents = $this->request(self::$method, self::$languages_route, ['headers' => $this->headers]);

       return json_decode($contents, true);
   }

   final public function getDictionaryLanguages() : array
   {
      
   }


/*
   public function getSourceLanguages() : array
   {
       $this->query['type'] = 'source';

       $contents = $this->request(self::$method, self::$languages_route, ['headers' => $this->headers, 'query' => $this->query]); 

       return json_decode($contents, true);
   } 

   public function getTargetLanguages() : array
   {
       $this->query['type'] = 'target';

       $contents = $this->request(self::$method, self::$languages_route, ['headers' => $this->headers, 'query' => $this->query]); 

       return json_decode($contents, true);
   } 
*/

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang); 

       $this->query['text'] = urlencode($text);

       $contents = $this->request(self::$method, self::$trans_route, ['headers' => $this->headers, 'query' => $this->query]); 

       $obj = json_decode($contents);

       return urldecode($obj->translations????); 
   }
}
