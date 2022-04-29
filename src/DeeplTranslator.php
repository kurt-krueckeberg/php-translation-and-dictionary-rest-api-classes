<?php
declare(strict_types=1);
namespace LanguageTools;

// SeeDeepl-doc.md 
class DeeplTranslator extends RestClient implements TranslateInterface {
   
   static private string $method = "GET";    
   static private string $from_key = "source_lang"; 
   static private string $to_key = "target_lang";  
   static private string $trans_route = "v2/translate";     
   static private string $languages_route = "v2/languages";     

   private $query = array();
   private $headers = array();
 
   public function __construct(DeeplConfig $c = new DeeplConfig)
   {   
      parent::__construct($c->endpoint);

     $this->header[array_key_first($c->header)] = $c->header[array_key_first($c->header)];
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


   public function getTranslationLanguages() : array
   {
       // $this->query['type'] = 'target' or 'source';

       $contents = $this->request(self::$method, self::$languages_route, ['headers' => $this->headers]);

       return json_decode($contents, true);
   } 

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang); 

       $this->query['text'] = urlencode($text);

       $contents = $this->request(self::$method, self::$trans_route, ['headers' => $this->headers, 'query' => $this->query]); 

       $obj = json_decode($contents);

       return urldecode($obj->translations[0]->text); 
   }
}
