<?php
use \Guzzle\Http\Client as Client;

include "vendor/autoload.php";

/*
 *
 GET Request for sentences for the word 'vernachlässigen', start with first sentnece and give me 10:

 http://api.corpora.uni-leipzig.de/ws/sentences/deu_news_2012_1M/sentences/vernachl%C3%A4ssigen?offset=0&limit=10
 *
 */
class SentenceFetcher {

   static $base_url = "http://api.corpora.uni-leipzig.de/ws/sentences/";

   private $uri;
   private $base_uri;

   private $header;

   public function __construct($corpus) 
   {
      $this->uri = $corpus . '/sentences/'; 	   

      $this->client = new Client($base_uri);

      $this->header = "accept: application/json"; //<---???
   }

   public function get(string $word, $offset = 0, $limit = 7)
   {
      /*
       *  TODO: Guzzle Client requests can also be sent asynchronously. This can be done, too, using 'promise' objects like C++.
       *
       */  
      $uri = $this->uri . urlencode($word);

      try {

         $response = $client->request('GET', $uri, array('query' => array('offset' => 0, 'limit' => 10)) );
      
         $result = $response->getBody()->getContents();
      
         return $result;
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;

      }  catch (\Exception $e) { 

         return; // TODO: Should this be different?
      }
   }
 
}
