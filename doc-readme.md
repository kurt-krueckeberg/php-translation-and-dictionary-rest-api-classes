<div class="container">

# Creating Sample Sentences for Language Learning

Creating sample sentences for learning a language using the and Leipzip Sentence Corpus Code and Deeepl Free Api.

## University of Leipzip Free Sentence Corpus RESTful API

Free **REST API of the Leipzig Corpora Collection / Projekt Deutscher Wortschatz** online [documentation](http://api.corpora.uni-leipzig.de/ws/swagger-ui.html)
 
Propspective Sample PHP class to fetch sentences for a given German word:

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

## Deepl Free API

## Free Deepl API Documentation

Deepl API Documentation [online](https://www.deepl.com/docs-api).


### Translation Request Parameters

Online documentation of Deepl [Request Parameters](https://www.deepl.com/docs-api/translating-text/request/)


+---------+---------+-------------------------------------------------+
| Pa      | O       | Description                                     |
| rameter | ptional |                                                 |
+=========+=========+=================================================+
| text    | R       | Text to be translated. Only UTF8-encoded plain  |
|         | equired | text is supported. The parameter may be         |
|         |         | specified multiple times and translations are   |
|         |         | returned in the same order as they are          |
|         |         | requested. Each of the parameter values may     |
|         |         | contain multiple sentences. Up to 50 texts can  |
|         |         | be sent for translation in one request.         |
+---------+---------+-------------------------------------------------+
| sourc   | O       | Language of the text to be translated. Options  |
| e\_lang | ptional | currently available:                            |
|         |         |                                                 |
|         |         | -   \"BG\" - Bulgarian                          |
|         |         |                                                 |
|         |         | -   \"CS\" - Czech                              |
|         |         |                                                 |
|         |         | -   \"DA\" - Danish                             |
|         |         |                                                 |
|         |         | -   \"DE\" - German                             |
|         |         |                                                 |
|         |         | -   \"EL\" - Greek                              |
|         |         |                                                 |
|         |         | -   \"EN\" - English                            |
|         |         |                                                 |
|         |         | -   \"ES\" - Spanish                            |
|         |         |                                                 |
|         |         | -   \"ET\" - Estonian                           |
|         |         |                                                 |
|         |         | -   \"FI\" - Finnish                            |
|         |         |                                                 |
|         |         | -   \"FR\" - French                             |
|         |         |                                                 |
|         |         | -   \"HU\" - Hungarian                          |
|         |         |                                                 |
|         |         | -   \"IT\" - Italian                            |
|         |         |                                                 |
|         |         | -   \"JA\" - Japanese                           |
|         |         |                                                 |
|         |         | -   \"LT\" - Lithuanian                         |
|         |         |                                                 |
|         |         | -   \"LV\" - Latvian                            |
|         |         |                                                 |
|         |         | -   \"NL\" - Dutch                              |
|         |         |                                                 |
|         |         | -   \"PL\" - Polish                             |
|         |         |                                                 |
|         |         | -   \"PT\" - Portuguese (all Portuguese         |
|         |         |     varieties mixed)                            |
|         |         |                                                 |
|         |         | -   \"RO\" - Romanian                           |
|         |         |                                                 |
|         |         | -   \"RU\" - Russian                            |
|         |         |                                                 |
|         |         | -   \"SK\" - Slovak                             |
|         |         |                                                 |
|         |         | -   \"SL\" - Slovenian                          |
|         |         |                                                 |
|         |         | -   \"SV\" - Swedish                            |
|         |         |                                                 |
|         |         | -   \"ZH\" - Chinese                            |
|         |         |                                                 |
|         |         | If this parameter is omitted, the API will      |
|         |         | attempt to detect the language of the text and  |
|         |         | translate it.                                   |
+---------+---------+-------------------------------------------------+
| targe   | R       | The language into which the text should be      |
| t\_lang | equired | translated. Options currently available:        |
|         |         |                                                 |
|         |         | -   \"BG\" - Bulgarian                          |
|         |         |                                                 |
|         |         | -   \"CS\" - Czech                              |
|         |         |                                                 |
|         |         | -   \"DA\" - Danish                             |
|         |         |                                                 |
|         |         | -   \"DE\" - German                             |
|         |         |                                                 |
|         |         | -   \"EL\" - Greek                              |
|         |         |                                                 |
|         |         | -   \"EN-GB\" - English (British)               |
|         |         |                                                 |
|         |         | -   \"EN-US\" - English (American)              |
|         |         |                                                 |
|         |         | -   \"EN\" - English (unspecified variant for   |
|         |         |     backward compatibility; please select EN-GB |
|         |         |     or EN-US instead)                           |
|         |         |                                                 |
|         |         | -   \"ES\" - Spanish                            |
|         |         |                                                 |
|         |         | -   \"ET\" - Estonian                           |
|         |         |                                                 |
|         |         | -   \"FI\" - Finnish                            |
|         |         |                                                 |
|         |         | -   \"FR\" - French                             |
|         |         |                                                 |
|         |         | -   \"HU\" - Hungarian                          |
|         |         |                                                 |
|         |         | -   \"IT\" - Italian                            |
|         |         |                                                 |
|         |         | -   \"JA\" - Japanese                           |
|         |         |                                                 |
|         |         | -   \"LT\" - Lithuanian                         |
|         |         |                                                 |
|         |         | -   \"LV\" - Latvian                            |
|         |         |                                                 |
|         |         | -   \"NL\" - Dutch                              |
|         |         |                                                 |
|         |         | -   \"PL\" - Polish                             |
|         |         |                                                 |
|         |         | -   \"PT-PT\" - Portuguese (all Portuguese      |
|         |         |     varieties excluding Brazilian Portuguese)   |
|         |         |                                                 |
|         |         | -   \"PT-BR\" - Portuguese (Brazilian)          |
|         |         |                                                 |
|         |         | -   \"PT\" - Portuguese (unspecified variant    |
|         |         |     for backward compatibility; please select   |
|         |         |     PT-PT or PT-BR instead)                     |
|         |         |                                                 |
|         |         | -   \"RO\" - Romanian                           |
|         |         |                                                 |
|         |         | -   \"RU\" - Russian                            |
|         |         |                                                 |
|         |         | -   \"SK\" - Slovak                             |
|         |         |                                                 |
|         |         | -   \"SL\" - Slovenian                          |
|         |         |                                                 |
|         |         | -   \"SV\" - Swedish                            |
|         |         |                                                 |
|         |         | -   \"ZH\" - Chinese                            |
+---------+---------+-------------------------------------------------+
| sp      | O       | Sets whether the translation engine should      |
| lit\_se | ptional | first split the input into sentences. This is   |
| ntences |         | enabled by default. Possible values are:        |
|         |         |                                                 |
|         |         | -   \"0\" - no splitting at all, whole input is |
|         |         |     treated as one sentence                     |
|         |         |                                                 |
|         |         | -   \"1\" (default) - splits on punctuation and |
|         |         |     on newlines                                 |
|         |         |                                                 |
|         |         | -   \"nonewlines\" - splits on punctuation      |
|         |         |     only, ignoring newlines                     |
|         |         |                                                 |
|         |         | For applications that send one sentence per     |
|         |         | text parameter, it is advisable to set          |
|         |         | split\_sentences=0, in order to prevent the     |
|         |         | engine from splitting the sentence              |
|         |         | unintentionally.                                |
+---------+---------+-------------------------------------------------+
| preser  | O       | Sets whether the translation engine should      |
| ve\_for | ptional | respect the original formatting, even if it     |
| matting |         | would usually correct some aspects. Possible    |
|         |         | values are:                                     |
|         |         |                                                 |
|         |         | -   \"0\" (default)                             |
|         |         |                                                 |
|         |         | -   \"1\"                                       |
|         |         |                                                 |
|         |         | The formatting aspects affected by this setting |
|         |         | include:                                        |
|         |         |                                                 |
|         |         | -   Punctuation at the beginning and end of the |
|         |         |     sentence                                    |
|         |         |                                                 |
|         |         | -   Upper/lower case at the beginning of the    |
|         |         |     sentence                                    |
+---------+---------+-------------------------------------------------+
| fo      | O       | Sets whether the translated text should lean    |
| rmality | ptional | towards formal or informal language. This       |
|         |         | feature currently only works for target         |
|         |         | languages **\"DE\" (German), \"FR\" (French),   |
|         |         | \"IT\" (Italian), \"ES\" (Spanish), \"NL\"      |
|         |         | (Dutch), \"PL\" (Polish), \"PT-PT\", \"PT-BR\"  |
|         |         | (Portuguese) and \"RU\" (Russian)**.Possible    |
|         |         | options are:                                    |
|         |         |                                                 |
|         |         | -   \"default\" (default)                       |
|         |         |                                                 |
|         |         | -   \"more\" - for a more formal language       |
|         |         |                                                 |
|         |         | -   \"less\" - for a more informal language     |
+---------+---------+-------------------------------------------------+
| gloss   | O       | Specify the glossary to use for the             |
| ary\_id | ptional | translation. **Important:** This requires the   |
|         |         | source\_lang parameter to be set and the        |
|         |         | language pair of the glossary has to match the  |
|         |         | language pair of the request.                   |
+---------+---------+-------------------------------------------------+

### Extended Parameters

The following extended parameters are also available. Please refer to
the \"Handling XML\" section below for further information on how to use
these parameters.

+---------+---------+-------------------------------------------------+
| Pa      | O       | Description                                     |
| rameter | ptional |                                                 |
+=========+=========+=================================================+
| tag\_h  | O       | Sets which kind of tags should be handled.      |
| andling | ptional | Options currently available:                    |
|         |         |                                                 |
|         |         | -   \"xml\"                                     |
+---------+---------+-------------------------------------------------+
| non\_s  | O       | Comma-separated list of XML tags which never    |
| plittin | ptional | split sentences.                                |
| g\_tags |         |                                                 |
+---------+---------+-------------------------------------------------+
| outl    | O       | Please see the \"Handling XML\" section for     |
| ine\_de | ptional | further details.                                |
| tection |         |                                                 |
+---------+---------+-------------------------------------------------+
| s       | O       | Comma-separated list of XML tags which always   |
| plittin | ptional | cause splits.                                   |
| g\_tags |         |                                                 |
+---------+---------+-------------------------------------------------+
| ignor   | O       | Comma-separated list of XML tags that indicate  |
| e\_tags | ptional | text not to be translated.                      |
+---------+---------+-------------------------------------------------+

Prospective Github.com PHP Deepl repsitories:

This github repository uses PHP and Guzzle

- [Deepl-Client](https://github.com/tinyappsde/deepl-client)

## Tools and Libraries Used

### Guzzle for PHP REST Client

This github repository uses PHP and Guzzle

    [deepl-client](https://github.com/tinyappsde/deepl-client)
    
Helpful articles explaining how to use Guzzle:

- Medium.com article showing a [complete example](https://medium.com/hackernoon/creating-rest-api-in-php-using-guzzle-d6a890499b02) of using Guzzle as a REST API client for a 3rd party API (Cloudways API) 

- Guzzle [Docs](https://docs.guzzlephp.org/en/stable/index.html)

- Guzzle [github](https://github.com/guzzle/guzzle) shows Guzzle installation using Composer.

</div>
