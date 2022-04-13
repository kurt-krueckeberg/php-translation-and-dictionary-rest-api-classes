<?php
use GuzzleHttp\Client as Client;

include "vendor/autoload.php";

class SentenceFetcher {

   private static $offset = 'offset';
   private static $limit = 'limit';
   private $route;
   private $client;

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.

   public function __construct(\SimpleXMLElement $xml)
   {
      $query = sprintf(self::$xpath, "l"); 
     
      $provider = $xml->xpath($query)[0];
      
      $this->setConfig($provider);
 
      $this->client = new Client(['base_uri' => (string) $provider->settings->baseurl]);
   }
   
   private function setConfig(\SimpleXMLElement $p)
   {
      $this->route = $p->requests->request->route;
      $this->method = $p->requests->request->route;

      $query = array();

      foreach($p->settings->query->parm as $parm)  
              $query_array[ (string) $parm["name"] ] = urlencode( (string) $parm );

      $this->options['query'] = $query_array;
    }

 /* 
    get_sentences() returns an array of SentenceInformation objects, each with these properties:

    1. id
    2. sentence - the actual text of the sample sentence
    3. source - of type information, the URI 

    Clients can extract the sentence with this loop:

    foreach ($obj->sentences as $sentence_information) {

       $sentence = $sentence_information->sentence;
       //...snip
     }
 
    After get_sentences() executes

         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);

    $obj is a SentenceList object with these properties: 

    1. count - integer, size of sentences[] array
    2. sentences[count] - an array of count SentenceInformation elements.

    get_sentences() returns the sentences[count] array.
   */

   public function fetch(string $word, int $count=3) : \Iterator
   {
      $url = $this->route . '/' . urlencode($word);

      $response = $this->client->request('GET', $url, ['query' => [self::$offset => 0, self::$limit => $count]]);
      
      $contents = $response->getBody()->getContents();
 
      // urlecode?
      $obj = json_decode($contents);

       /* 
         SentenceInformation (is an object) containing:
   
           1. id
           2. sentence - the actual string text of the sample sentence
           3. source - of type SourceInformation 
        */

      return $obj->sentences; // Return the array of SentenceInformation objects  
      
   }
}