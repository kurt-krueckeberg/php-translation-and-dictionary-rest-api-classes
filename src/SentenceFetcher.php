<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client as Client;

class SentenceResultsIterator  extends ResultsIteratorBase { 
 
    //public function __construct(array $objs)
    public function __construct(array $objs)
    {
       parent::__construct($objs); 
    }

    protected function get_current(mixed $current) : mixed
    {
        return $current->sentence;
    }
}

class SentenceFetcher extends RestClient {

   private static $route = "sentences/deu_news_2012_1M/sentences" ;
   private static $method = 'GET';

   public function __construct(\SimpleXMLElement $provider, string $abbrev)
   {
       parent::__construct($provider, $abbrev); 
   }
   
   public function fetch(string $word, int $count=3) : SentenceResultsIterator
   {
      $route = self::$route. '/' . urlencode($word);

      $contents = $this->request(self::$method, $route , ['query' => ['offset' => 0, 'limit' => $count]]);
      
      $obj = json_decode($contents);

     /*
       This is what is returned:
       
       {
         "count": 0,
         "sentences": [ // SentenceInfomration json object.
           {
             "id": "string",
             "sentence": "string",
             "source": {
               "date": "2022-04-13T12:40:23.904Z",
               "id": "string",
               "url": "string"
             }
           }
         ]
       }
     
         SentenceInformation is a PHP stdClass containing:
   
           1. id  => string
           2. sentence => the actual string text of the sample sentence
           3. source => ["daate" => ..., "id" => string, "url" => string]
        */

      return new SentenceResultsIterator( $obj->sentences ); // Return the array of SentenceInformation objects  
   }
}
