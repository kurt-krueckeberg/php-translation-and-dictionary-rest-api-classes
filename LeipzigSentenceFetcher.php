<?php
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException as RequestException;

include "vendor/autoload.php";

/*
 * The class uses the Uiv. of Leipzig Sentences Corpus REST API. Example:
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
    get_sentences() returns an array of Leipzig SentenceInformation objects that have three properties:

    1. id
    2. sentence - the actual text of the sample sentence
    3. source - of type information, the URI 

    Clients get extract the sentence text with this loop:

    foreach ($obj->sentences as $sentence_information) {

       $sentence = $sentence_information->sentence;
       //...snip
     }
 
    Further Comments: After this code is first executed

         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);

    $obj will be a Leipzig SentenceList object with these two properties: 

    1. count - integer, size of sentences[] array
    2. sentences[count] - an array of count SentenceInformation elements.

    sentences[count] is returned.
   */
    
   public function get_sentences(string $word, $count=10)
   {
      $uri = $this->uri . '/' . urlencode($word);

      try {

         $query =  ['query' => [LeipzigSentenceFetcher::$qs_offset => 0, LeipzigSentenceFetcher::$qs_limit => $count]];

         $response = $this->client->request('GET', $uri, $query);
         
         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);

         return $obj->sentences; // Return array of SentenceInformation objects  
      
      } catch (RequestException $e) { // We get here if response code from REST server is > 400, like  404 response

         /* Check if a response was received */
         if ($e->hasResponse())
             
            $str = "Response Code is " . $e->getResponse()->getStatusCode();
         else 
             $str = "No respons from server.";

         throw new Exception("Guzzle RequestException. $str"); 
    }
  }
}
