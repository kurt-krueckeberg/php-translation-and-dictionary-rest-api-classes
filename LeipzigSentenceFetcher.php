<?php
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException as RequestException;

include "vendor/autoload.php";

class LeipzigSentenceFetcher {

   //--private static $qs_offset = 'offset';
   //--private static $qs_limit = 'limit';
   private $route;

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.

   public function __construct(\SimpleXMLElement $xml)
   {
      $query = sprintf(self::$xpath, "l"); 
     
      $provider = $xml->xpath($query)[0];
      
      $this->setConfig(($provider);
 
      $this->route = $provider->requests->request->route;

      $this->client = new Client(['base_uri' => (string) $provider->settings->baseurl]);
   }
   
   private function setConfig(\SimpleXMLElemen $p)
   {
      $this->route = $p->requests->request->route;
      // todo:finish
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
    
   public function get_sentences(string $word, int $count=10)
   {
      $url = $this->route . '/' . urlencode($word);

      $response = $this->client->request('GET', $url, ['query' => [LeipzigSentenceFetcher::$qs_offset => 0, LeipzigSentenceFetcher::$qs_limit => $count]]);
      
      $contents = $response->getBody()->getContents();

      $obj = json_decode($contents);

      return $obj->sentences; // Return the array of SentenceInformation objects  
      
    }
}
