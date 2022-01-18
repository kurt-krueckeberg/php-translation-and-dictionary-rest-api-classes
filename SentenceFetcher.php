<?php
/*
 *
 GET Request for sentences for the word 'vernachlässigen', start with first sentnece and give me 10:

 http://api.corpora.uni-leipzig.de/ws/sentences/deu_news_2012_1M/sentences/vernachl%C3%A4ssigen?offset=0&limit=10
 *
 */
class SentenceFetcher {

   private $client = null;

   static $Service = "http://api.corpora.uni-leipzig.de/ws/sentences/";

   private $uri;

   public function __construct(string $corpus)
   {
   
      $this->uri = self::$Service . $corpus . '/sentences/'; 	   

      $this->client = new Client();

      $this->header = "accept: application/json";

   }

   public function get(string $word, $offset = 0, $limit = 4)
   {
      try {

	 $url = $this->uri . urlencode($word) . "?" . "offset=$offset&limit=$limit";   

         $response = $this->client->get($url, array("headers" => $header) );
      
         $result = $response->getBody()->getContents();
      
         return $result;
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;
      }
   }
}

