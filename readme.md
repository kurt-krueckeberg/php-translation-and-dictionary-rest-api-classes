# Deeepl Free Api and Leipzip Sentence Corpus Code

## Free Deepl API Documentation

Free Deepl API Documentation [online](https://www.deepl.com/docs-api).

The PHP REST Client will be Guzzle:

- Guzzle REST client [full example](https://medium.com/hackernoon/creating-rest-api-in-php-using-guzzle-d6a890499b02)
- Guzzle [Docs](https://docs.guzzlephp.org/en/stable/index.html)
- Guzzle [github](https://github.com/guzzle/guzzle) shows installation using Composer

## University of Leipzip Free Sentence Corpus API

[Documentation](http://api.corpora.uni-leipzig.de/ws/swagger-ui.html)
 for free **REST API of the Leipzig Corpora Collection / Projekt Deutscher Wortschatz**.
 
Sample PHP class to fetch sentences for a given German word:

```php
// TODO: Add that JSON response will be accepted by this client.

class LeipzipSentenceFetch {
    
   static $base_uri = "http://api.corpora.uni-leipzig.de/ws";

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.

   public function __construct($corpus="deu_news_2012_1M") 
   {
      $this->uri = $corpus . '/sentences'; 	   

      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; //<--- ?
   }

   public function get(string $word, $offset = 0, $limit = 7)
   {
      /*
       *  TODO: Guzzle Client requests can also be sent asynchronously. This can be done, too, using 'promise' objects like C++.
       *
       */  
      $uri = $this->uri . '/' . urlencode($word);

      try {

         $response = $this->client->request('GET', $uri, array('query' => array('offset' => $offset, 'limit' => $limit)) );
      
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

```
