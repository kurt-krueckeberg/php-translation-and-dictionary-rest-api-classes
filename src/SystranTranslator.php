<?php
declare(strict_types=1);
namespace LanguageTools;

// Under development
class SystranTranslator extends RestClient implements TranslateInterface, DictionaryInterface {

   static private array  $trans     = array('method' => "POST", 'route' => "translation/text/translate");
   static private array  $languages = array('method' => "GET", 'route' => "/translation/supportedLanguages");
   static private array  $lookup    = array('method' => "POST", 'route' => "/??????");

   static private $input = 'input'; // todo: Does lookup also use the pam 'input'?
   static private string $from = "source";
   static private string $to = "target";

   private array $headers = array();
   private array $query = array(); 

   /*
    There can be more than one query 'option' set; ii.e., the 'options' query paramter can occur more than one. 
    I guess that would mean $thi->query['option'] = ['aaa', 'bbb', ... ];
    */
   
   public function __construct(SystranConfig $c = new SystranConfig)
   {
       parent::__construct($c->endpoint);

       $this->headers[array_key_first($c->header)] = $c->header[array_key_first($c->header)];
   }     

   // Called by base Translator::translate method 
   final protected function add_input(string $text)
   {
       $this->query[self::$input] = urlencode($text);  
   }

   public function getTranslationLanguages() : array
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      $arr = json_decode($contents, true);
    
      return $arr["translation"]; 
    } 

   final public function getDictionaryLanguages() : array
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      return json_decode($contents, true);    
   } 

  // If there is no source language, the source langauge will be auto-detected.
  // todo: 
  // The default expected encoding is utf-8. IF it is not utf-8 the 'options' paramter must be used to supply the endocing.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from] = $source_lang; 

      $this->query[self::$to] = $dest_lang; 
   }

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang); // If the language is not utf-8, then the 'options' query parameter must be used to sppecify the endocing.

       $this->add_input($text);

       $contents = $this->request(self::$trans['method'], self::$trans['route'], ['headers' => $this->headers, 'query' => $this->query]); 

       $obj = json_decode($contents);
/*
This is the response TranslationResponse object, according to https://docs.systran.net/translateAPI/translation/#tag-Translation

{
  "error": {
    "message": "Internal error",
    "statusCode": 500,
    "info": "object"
  },
  "requestId": "55b753d87f2d682a607b8be1",
  "outputs": [
    {
      "error": "Internal error",
      "info": {
        "lid": {
          "language": "en",
          "confidence": 0.9260174036026001
        },
        "selected_routes": [
          {
            "routes": [
              {
                "profileId": "6b80a3f5-aff2-41ba-a5ce-21603738432e",
                "queue": "6b80a3f5-aff2-41ba-a5ce-21603738432e",
                "service": "Translate_en_fr",
                "version": 2,
                "selectors": "object"
              }
            ],
            "stepName": "filter-import"
          }
        ],
        "stats": "object"
      },
      "output": "le chien",   <--------- Translation
      "backTranslation": "the dog",
      "source": "the dog"
    }
  ]
}

*/
       print_r($obj);  
       return $obj;
   }


   /*
    *   Documentation at https://docs.systran.net/translateAPI/dictionary/
    */
   final public function lookup(string $word, string $src_lang, string $dest_lang) : string 
   {      
      $this->setLanguages($dest_lang, $src_lang); 
       
      $this->add_input($word);
    
      $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['headers' => $this->headers, 'query' => $this->query]);

      $obj = json_decode($contents)[0]; 
    
      return $obj;
    }
}
