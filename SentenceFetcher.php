<?php
use GuzzleHttp\Client;

require 'vendor/autoload.php';

class SentenceFetcher {
    
   static $base_uri = "http://api.corpora.uni-leipzig.de/ws";

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.

   public function __construct(string $corpus)
   {
      $this->uri = $corpus . '/sentences'; 	   

      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; //<--- ?
   }

   public function get(string $word, $offset = 0, $limit = 7)
   {
       
      $uri = $this->uri . '/' . urlencode($word);

      try {

         $response = $this->client->request('GET', $uri, array('query' => array('offset' => $offset, 'limit' => $limit)) );
      
         $result = $response->getBody()->getContents();
         
         return $result;
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;

      }  catch (\Exception $e) { 

         throw $e; // re-throw
      }
   }
}
