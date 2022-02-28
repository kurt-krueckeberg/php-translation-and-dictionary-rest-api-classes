<?php
use GuzzleHttp\Client as Client;

include "vendor/autoload.php";

include "config.php";

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

   public function get(string $word, $limit=10)
   {
      $uri = $this->uri . '/' . urlencode($word);

      try {

         $response = $this->client->request('GET', $uri, array('query' => array('offset' => 0, 'limit' => $limit)) );
    
         if ($response->getStatusCode() !== 200) { // 200 == success
              
             throw new Exception("Error..."); // TODO : Decide on exception type and message. 
         }
         
         return $response->getBody()->getContents();
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;
      }  
   }
}
