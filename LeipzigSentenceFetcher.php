<?php
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException as RequestException;

include "vendor/autoload.php";

/*
 * This class uses the free Univ. of Leipzig's Sentences Corpus REST API. An example RESTful API call with query paraemters:
 *
 * http://api.corpora.uni-leipzig.de/ws/sentences/deu_news_2012_1M/sentences/Handeln?offset=0&limit=10
 *
 * 'deu_news_2012_1M' is the default corpus (of German sentences) used by the constructor.
 *
 */

class LeipzigSentenceFetcher {

   private static $base_uri = "http://api.corpora.uni-leipzig.de/ws/sentences/";
   private static $qs_offset = 'offset';
   private static $qs_limit = 'limit';

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.

   public function __construct($corpus="deu_news_2012_1M") 
   {
      $this->uri = $corpus . '/sentences'; 	   

      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; 
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
    
   public function get_sentences(string $word, $count=10)
   {
      $uri = $this->uri . '/' . urlencode($word);
      echo "DEUBG URI is: $uri\n";

      try {

         $query =  ['query' => [LeipzigSentenceFetcher::$qs_offset => 0, LeipzigSentenceFetcher::$qs_limit => $count]];

         $response = $this->client->request('GET', $uri, $query);
         
         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);

         return $obj->sentences; // Return the array of SentenceInformation objects  
      
      } catch (RequestException $e) { // We get here if the response code from the Leipzig server is > 400 (or if it times out)

         /* If a response code was set, get it. */
         if ($e->hasResponse())
             
            $str = "Response Code is " . $e->getResponse()->getStatusCode();
         else 
             $str = "No respons from server.";

         throw new Exception("Guzzle RequestException. $str"); 
    }
  }
}
