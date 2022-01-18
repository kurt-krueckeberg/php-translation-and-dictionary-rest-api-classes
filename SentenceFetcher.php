<?php

class SentenceFetcher {

   private $client = null;

   //--private $auth_key;

   static $Service = "http://api.corpora.uni-leipzig.de/ws/sentences/";

   public function __construct(string $corpus)
   {
   
      $uri = self::$Service . $corpus . '/sentences/'; 	   

      $this->client = new Client();

      $this->header = "accept: application/json";
   }

   public function get(string $word, $offset, $limit)
   {
      
      // TODO: Figure out how to 'encode'  German umlauts for the query string
      
      try {
      
         $response = $this->client->get($url, array("headers" => $header) );
      
         $result = $response->getBody()->getContents();
      
         return $result;
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;
      }
   }
}

