<?php
declare(strict_types=1);
namespace LanguageTools;

// SeeDeepl-doc.md 
class DeeplTranslator extends RestClient implements TranslateInterface, LanguagesSupportedInterface {
   
   static private string $route = "v2/translate";     
   static private string $method = "GET";    
   static private string $from_key = "source_lang"; 
   static private string $to_key = "target_lang";  

   private $query = array();
   private $headers = array();
 
   public function __construct(protected \SimpleXMLElement $provider, string $abbrev) 
   {
       parent::__construct($provider, $abbrev); 

      $this->headers = [ ((string) $provider->settings->credentials->header['name']) => (string) $provider->settings->credentials->header]; 
   }

   // If this is a translation request and there is no source language, the source langauge will be auto-detected.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from_key] = $source_lang; 

      $this->query[self::$to_key] = $dest_lang; 
   }

   final public function getLanguages() : string
   {
       return "a string";
   }

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang); 

       $this->query['text'] = urlencode($text);

       $contents = $this->request(self::$method, self::$route, ['headers' => $this->headers, 'query' => $this->query]); 

       $obj = json_decode($contents);

       return urldecode($obj->translations[0]->text); 
   }
}
