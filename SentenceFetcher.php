<?php

class SentenceFetcher {

   private $client = null;

   private $auth_key;

   private $auth_email;

   private $accessToken;

   const API_URL = "http://api.corpora.uni-leipzig.de/ws";

   public function __construct($email, $key)
   {
      $this->auth_email = $email;
   
      $this->auth_key = $key;
   
      $this->client = new Client();
   }

   public function fetch(string $word)
   {
      $url = self::API_URL . "/server";
      
      $option = array('exceptions' => false);
      
      //$header = array('Authorization'=> 'Bearer ' , $this->accessToken);
      
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

