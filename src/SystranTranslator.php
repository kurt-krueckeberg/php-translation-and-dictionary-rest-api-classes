<?php
declare(strict_types=1);
namespace LanguageTools;

// Under development
class SystranTranslator extends RestClient implements TranslateInterface, DictionaryInterface {
   

   static private array  $trans = array('method' => "POST", 'route' => "/translation/text/translate");
   static private array  $languages = array('method' => "GET", 'route' => "languages");

   static private $trans_input = 'input';
   static private string $from = "source";
   static private string $to = "target";

   private $headers = array();
   private $query = array('api-version' => "3.0");
   
   public function __construct(AzureConfig $c = new SystranConfig)
   {
       parent::__construct($c->endpoint);

       $this->headers[array_key_first($c->header)] = $c->header[array_key_first($c->header)];
   }     

   // Called by base Translator::translate method 
   final protected function add_text(string $text)
   {
      // todo: Does we also need to do utf-8, 
      // The dfault expected encoding per docs is utf-8. This would be done before the urlencod()--right?  
       $this->query[self::$input] = urlencode($text);  
   }

   public function getTranslationLanguages() : array
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      $arr = json_decode($contents, true);
    
      return $arr["translation"]; 
    } 

   final public function getDictionaryLanguages() : array // todo: check the actual array to confirm it is what we want.
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      return json_decode($contents, true);    
   } 

   // If there is no source language, the source langauge will be auto-detected.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from] = $source_lang; 

      $this->query[self::$to] = $dest_lang; 
   }

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang);

       $this->add_text($text);

       $contents = $this->request(self::$trans['method'], self::$trans['route'], ['headers' => $this->headers, 'query' => $this->query]); 

       $obj = json_decode($contents);

       return $obj?????//[0]->translations[0]->text; 
   }

   // Azure Translator offers dictionary lookup service that returns a one-word definition.
   final public function lookup(string $word, string $src_lang, string $dest_lang) : string 
   {      
      $this->setLanguages($dest_lang, $src_lang); 
       
      $this->add_input($word);
    
      $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['headers' => $this->headers, 'query' => $this->query, 'json' => $this->json]);

      $obj = json_decode($contents)[0]; 
    
      ??  
    }
}
