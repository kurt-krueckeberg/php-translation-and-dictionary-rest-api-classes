<?php
declare(strict_types=1);
namespace LanguageTools;
use GuzzleHttp\Client as Client;


class GetSentence { // type 'callable'. 
   public function __invoke($obj)
   {
       return $obj->sentence;
   }
}

class LeipzigSentenceFetcher extends RestClient implements SentenceFetchInterface {

   private static $route = "sentences/deu_news_2012_1M/sentences" ;
   private static $method = 'GET';

   public function __construct(ClassID $id)
   {
       parent::__construct($id);
   }
   
   public function fetch(string $word, int $count=3) : ResultsIterator
   {
      $route = self::$route. '/' . urlencode($word);

      $contents = $this->request(self::$method, $route , ['query' => ['offset' => 0, 'limit' => $count]]);
      
      $obj = json_decode($contents);

     /*
       $obj contains:
       {
         "count": some_number_her,
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
       SentenceInformation is a 'stdClass' containing:   
           1. id  => string
           2. sentence => the actual string text of the sample sentence
           3. source => ["daate" => ..., "id" => string, "url" => string]
        */

      // The iterator returns the 'sentence' member (of the SentenceInformation objects).
      return new ResultsIterator( $obj->sentences, function ($x) { return $x->sentence; } ); 
   }
}
