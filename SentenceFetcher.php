<?php
use GuzzleHttp\Client as Client;

include "vendor/autoload.php";

/*
 *
 GET Request for sentences for the word 'vernachlässigen', start with first sentnece and give me 10:
 http://api.corpora.uni-leipzig.de/ws/sentences/deu_news_2012_1M/sentences/vernachl%C3%A4ssigen?offset=0&limit=10
 *
 */

class SentenceFetcher {

   static $base_uri = "http://api.corpora.uni-leipzig.de/ws/sentences/";

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.

   public function __construct($corpus="deu_news_2012_1M") 
   {
      $this->uri = $corpus . '/sentences'; 	   

      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; 
   }

 /* 
  The json object returned contains a SentencesList object that has just two properties:

    1. count - integer
    2. sentences - an array of SentenceInformation elements
  
  SentenceInformation is an object containing three properties:

     1. id
     2. sentence - the actual string text of the sample sentence
     3. source - of type SourceInformation 

  To iterate over the returned sentences in a loop:   

    foreach ($obj->sentences as $sentence_information) {

       $sentence = $sentence_information->sentence;
       
       //...

     }
   */
    
   public function get_sentences(string $word, $count=10)
   {
      $uri = $this->uri . '/' . urlencode($word);

      try {

         $response = $this->client->request('GET', $uri, array('query' => array('offset' => 0, 'limit' => $count)) );
    
         if ($response->getStatusCode() !== 200) { // 200 == success
              
             throw new Exception("Error..."); // TODO : Decide on exception type and message. 
         }
         
         $contents = $response->getBody()->getContents();

         return json_decode($contents); // Returns stdClass described above.
      
      } catch (RequestException $e) {

         // TODO: Needs some work.      
         $response = $this->StatusCodeHandling($e);
         return $response;
      }  
   }
}
