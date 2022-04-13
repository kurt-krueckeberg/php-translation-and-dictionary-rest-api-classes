<?php
use GuzzleHttp\Client as Client;

include "vendor/autoload.php";

class SentenceInformationResultsIterator implements \Iterator {

    private array $sents;
    private int $cnt;
    private int $current;

    public function __construct(array $objs, int $count) 
    {
       $this->sents = $objs;
       $this->cnt = $count;
       $this->current = 0; 
    }

    public function current(): mixed
    {
        return $this->sents[$current]->sentence;
    }

    public function key(): mixed
    {
         return $this->current;
    }

    public function next(): void
    {
       ++$this->current;

    }
    public function rewind(): void
    {
       $this->current = 0; 
    }

    public function valid(): bool
    {
      return ($this->cnt !== $this->current); 
    }
}
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

   public function fetch(string $word, int $count=3) : SentenceInformationResultsIterator 
   {
      $url = $this->route . '/' . urlencode($word);

      $response = $this->client->request('GET', $url, ['query' => [self::$offset => 0, self::$limit => $count]]);
      
      $contents = $response->getBody()->getContents();
 
      // urlecode?
      $obj = json_decode($contents);

     /*
       This is what Leipzip returns
       
       {
         "count": 0,
         "sentences": [ // SentenceInfomration json object.
           {
             "id": "string",
             "sentence": "string",
             "source": {
               "date": "2022-04-13T12:40:23.904Z",
               "id": "string",
               "url": "string"
             }
           }
         ]
       }
     
         SentenceInformation is an object, (stdClass) containing:
   
           1. id  => string
           2. sentence => the actual string text of the sample sentence
           3. source => ["daate" => ..., "id" => string, "url" => string]
        */

      return new SentenceInformationResultsIterator( $obj->sentences, $obj->count ); // Return the array of SentenceInformation objects  
   }
}
