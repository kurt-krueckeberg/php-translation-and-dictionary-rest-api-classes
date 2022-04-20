<?php
declare(strict_types=1);
namespace LanguageTools;

class AzureTranslator extends /*RestClient*/ TranslatorWithDictionary implements DictionaryInterface, TranslateInterface {

   static private array  $lookup = array('method' => "POST", 'route' => "dictionary/lookup");
   static private array  $trans = array('method' => "POST", 'route' => "translate");
   static private array  $languages = array('method' => "GET", 'route' => "languages");
   static private string $from = "from";
   static private string $to = "to";

   // rquired query parameter 
   private $query = array('api-version' => "3.0");
   private $headers = array();
   private $json = array();

   private $options = array(); /// todo: build during constructor call.

   //protected \SimpleXMLElement $provider; // <---- set on constructor.
   
    // Azure Translator REST calls can also accept a GUID
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
   
   public function __construct(\SimpleXMLElement $provider, string $abbrev)
   {
        parent::__construct($provider, $abbrev);        

        foreach($provider->settings->credentials->header as $header) 
          
               $this->headers[(string) $header['name']] = (string) $header;
   }     

   // Called by base Translator::translate method 
   final protected function add_input(string $text)
   {
      $this->json = [['Text' => $text]];       
   }

   // If this is a translation request and there is no source language, the source langauge will be auto-detected.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from] = $source_lang; 

      $this->query[self::$to] = $dest_lang; 
   }

   public function getTranslationLanguages()
   {
      $this->query['scope'] = 'translation';

      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      $obj = json_decode($contents);
    
      print_r($obj->translation); 
 
      $str = "German";
 
      echo "In Test::getLanguages() " . self::$trans_route . "\n";
 
      return $str;
   } 

   final public function getDictionaryLanguages()
   {
      $this->query['scope'] = 'dictionary';

      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      $obj = json_decode($contents);
    
      print_r($obj); 
 
      $str = "German";
 
      echo "In Test::getLanguages() " . self::$trans_route . "\n";
 
      return $str;
   } 

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang);

       $this->add_input($text);

       $response = $this->request(self::$trans['method'], self::$trans['route'], ['headers' => $this->headers, 'query' => $this->query, 'json' => $this->json]); 

       $obj = json_decode($contents);

       return $obj[0]->translations[0]->text; 
   }

   // Azure Translator offers dictionary lookup service that returns a one-word definition.
   final public function lookup(string $word, string $src_lang, string $dest_lang) : string 
   {
      // 1. Set the dictionary languages
      $this->setLanguages($dest_lang, $src_lang); 
       
      $this->add_input($word);

      // 3. Issue post request 
      $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['headers' => $this->headers, 'query' => $this->query, 'json' => $this->json]);

      $obj = json_decode($contents)[0]; 
      
      return $obj->translations[0]->displayTarget; 
   }
}
