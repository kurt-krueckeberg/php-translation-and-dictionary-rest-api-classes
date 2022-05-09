<?php
declare(strict_types=1);
namespace LanguageTools;

class AzureTranslator extends RestClient implements DictionaryInterface, TranslateInterface {

   static private array  $lookup = array('method' => "POST", 'route' => "dictionary/lookup");
   static private array  $examples = array('method' => "POST", 'route' => "dictionary/examples");
   static private array  $trans = array('method' => "POST", 'route' => "translate");
   static private array  $languages = array('method' => "GET", 'route' => "languages");
   static private string $from = "from";
   static private string $to = "to";

   // rquired query parameter 
   private $query = array('api-version' => "3.0");
   private $headers = array();
   private $json = array();
   
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
   
   public function __construct(AzureConfig $c = new AzureConfig)
   {
       parent::__construct($c->endpoint);

       foreach($c->headers as $key => $value) 
          
            $this->headers[$key] = $value;
   }     

   // Called by base Translator::translate method 
   final protected function add_input(string $text)
   {
       $this->json = [['Text' => $text]];       
   }

   // If there is no source language, the source langauge will be auto-detected.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from] = $source_lang; 

      $this->query[self::$to] = $dest_lang; 
   }

   public function getTranslationLanguages() : array
   {
      $this->query['scope'] = 'translation';

      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      $arr = json_decode($contents, true);
    
      return $arr["translation"]; 
    } 

   final public function getDictionaryLanguages() : array // todo: check the actual array to confirm it is what we want.
   {
      $this->query['scope'] = 'dictionary';

      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      return json_decode($contents, true);    
   } 
   /*
   Translation response contents:
   [
       {
           "detectedLanguage": {
               "language": "en",
               "score": 1.0
           },
           "translations": [
               {
                   "text": "สวัสดี",
                   "to": "th",
                   "transliteration": {
                       "script": "Latn",
                       "text": "sawatdi"
                   }
               }
           ]
       }
   ]
   */
   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages($dest_lang, $source_lang);

       $this->add_input($text);

       $contents = $this->request(self::$trans['method'], self::$trans['route'], ['headers' => $this->headers, 'query' => $this->query, 'json' => $this->json]); 

       $obj = json_decode($contents);

       return arra($obj[0]->translations[0]->text); 
   }

   /* Azure Translatore loolup response body:
   [a      <-- array
    {
        "normalizedSource":"fly",
        "displaySource":"fly",
        "translations":[        <-- array
            {
                "normalizedTarget":"volar",
                "displayTarget":"volar",
                "posTag":"VERB",
                "confidence":0.4081,
                "prefixWord":"",
                "backTranslations":[
                    {"normalizedText":"fly","displayText":"fly","numExamples":15,"frequencyCount":4637},
                    {"normalizedText":"flying","displayText":"flying","numExamples":15,"frequencyCount":1365},
                    {"normalizedText":"blow","displayText":"blow","numExamples":15,"frequencyCount":503},
                    {"normalizedText":"flight","displayText":"flight","numExamples":15,"frequencyCount":135}
                ]
            },
            {
                "normalizedTarget":"mosca",
                "displayTarget":"mosca",
                "posTag":"NOUN",
                "confidence":0.2668,
                "prefixWord":"",
                "backTranslations":[
                    {"normalizedText":"fly","displayText":"fly","numExamples":15,"frequencyCount":1697},
                    {"normalizedText":"flyweight","displayText":"flyweight","numExamples":0,"frequencyCount":48},
                    {"normalizedText":"flies","displayText":"flies","numExamples":9,"frequencyCount":34}
                ]
            },
            //
            // ...list abbreviated for documentation clarity
            //
        ]
    }
   ]
    */
   final public function lookup(string $word, string $src_lang, string $dest_lang) : array
   {      
      $this->setLanguages($dest_lang, $src_lang); 
       
      $this->add_input($word);
    
      $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['headers' => $this->headers, 'query' => $this->query, 'json' => $this->json]);

      $obj = json_decode($contents)[0]; 
      
      return $obj->translations;
      /*
      if (count($obj->translations) == 0) 
          return array("no definition");
      else 
          //--return $obj->translations[0]->displayTarget; 
          return new ResultsIterator($obj->translations, AzureTranslator::results_filter(...));
       * 
       */
   }

   /* Repsonse body for input of [ {"Text":"fly", "Translation":"volar"} ]
   [
       {
           "normalizedSource":"fly",
           "normalizedTarget":"volar",
           "examples":[
               {
                   "sourcePrefix":"They need machines to ",
                   "sourceTerm":"fly",
                   "sourceSuffix":".",
                   "targetPrefix":"Necesitan máquinas para ",
                   "targetTerm":"volar",
                   "targetSuffix":"."
               },      
               {
                   "sourcePrefix":"That should really ",
                   "sourceTerm":"fly",
                   "sourceSuffix":".",
                   "targetPrefix":"Eso realmente debe ",
                   "targetTerm":"volar",
                   "targetSuffix":"."
            },
            //
               // ...list abbreviated for documentation clarity
               //
           ]
       }
   ]
   */
   final public function examples(string $word, array $translations) : array
   {
       if (count($translations) > 10) // input limt is 10
          die(); // todo: change
       
      $input = array();

      foreach($translations as $trans) 
              
            $input[] = ['Text' => $word, 'Translation' => $trans->normalizedTarget]; 

      $contents = $this->request(self::$examples['method'], self::$examples['route'], ['headers' => $this->headers, 'query' => $this->query, 'json' => $input]);

      $obj = json_decode($contents); 
        
      return new ResultsIterator($obj, AzureTranslator::get_result(...)); 
   }

   public static function get_result(\stdClass $x) : \stdClass
   {
      $result = new \stdClass();

      $sentences = array();

      if (count($x->examples) != 0) { 

          foreach ($x->examples as $ex) 
            // todo: OR new \stdClass    
             $sentences[] = ['source' => $ex->sourcePrefix . $ex->sourceTerm . $ex->sourceSuffix, 'target' => $target = $ex->targetPrefix . $ex->targetTerm . $ex->targetSuffix];

      }

      $results->sentences = $sentences;
      return $result;          
   }
}
