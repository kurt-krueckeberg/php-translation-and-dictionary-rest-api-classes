<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client as Client;

/* New code
class SentenceResultsIterator  extends ResultsIteratorBase { 
 
    public function __construct(array $objs)
    {
       $this->sents = $objs;
       $this->cnt = count($objs);
       $this->current = 0; 
    }
    protected function get_current()
    {
        return $this->objs->sentence;
    }
}
*/

class SentenceResultsIterator implements \Iterator, \Countable { 

    private array $sents;
    private int $cnt;
    private int $current;

    public function __construct(array $objs) 
    {
       $this->sents = $objs;
       $this->cnt = count($objs);
       $this->current = 0; 
    }
    
    public function count(): int
    {
        return $this->cnt;
    }
    
    public function current(): mixed
    {
        return $this->sents[$this->current]->sentence;
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

   public function fetch(string $word, int $count=3) : SentenceResultsIterator 
   {
      $url = $this->route . '/' . urlencode($word);

      $response = $this->client->request('GET', $url, ['query' => [self::$offset => 0, self::$limit => $count]]);
      
      $contents = $response->getBody()->getContents();
 
      // todo: urlecode needed?
      $obj = json_decode($contents);

     /*
       This is what is returned:
       
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
     
         SentenceInformation is a PHP stdClass containing:
   
           1. id  => string
           2. sentence => the actual string text of the sample sentence
           3. source => ["daate" => ..., "id" => string, "url" => string]
        */

      return new SentenceResultsIterator( $obj->sentences ); // Return the array of SentenceInformation objects  
   }
}
