<?php
declare(strict_types=1);
namespace LanguageTools;

class AzureTranslator extends RestClient implements DictionaryInterface, TranslateInterface, LanguagesSupportedInterface  {

   static private string $dict_route = "dictionary/lookup";
   static private string $trans_route = "translate";
   static private string $languages_route = "languages";
   static private string $from = "from";
   static private string $to = "to";
   static private string $method = "POST";

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
   
   // PHP 8.0 required
   public function __construct(protected \SimpleXMLElement $provider)
   {
        parent::__construct($provider);        

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

   // Interfaces implemented below

   public function getLanguages() : string
   {
       $str = "German";
       echo "In Test::getLanguages() " . self::$trans_route . "\n";
       return $str;
   }

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang);

       $this->add_input($text);

       $contents = $this->request(self::$method, self::$trans_route, ['headers' => $this->headers, 'query' => $this->query, 'json' => $this->json]); 

       $obj = json_decode($contents);

       return $obj[0]->translations[0]->text; 
   }

   // Azure Translator offers dictionary lookup service, too.
   final public function lookup(string $word, string $src_lang, string $dest_lang) : string //todo: array?
   {
      // 1. Set the dictionary languages
      $this->setLanguages($dest_lang, $src_lang); 
       
      $this->add_input($word);

      // 3. Issue post request 
      $contents = $this->request(self::$method, self::$dict_route,  ['headers' => $this->headers, 'query' => $this->query, 'json' => $this->json]);

      $obj = json_decode($contents)[0]; 
      
      return $obj->translations[0]->displayTarget; 
   }
}
