<div class="container">

# Creating Sample Sentences for Language Learning

Creating sample sentences for learning a language using the and Leipzig Sentence Corpus Code and DEEPL Free Api.

## University of Leipzip Free Sentence Corpus RESTful API

The [Wortschatz Leipzig](https://wortschatz.uni-leipzig.de/en) is a database of more than 30 million sentences of German newspaper material that has a free RESTful [sentences-service API](http://api.corpora.uni-leipzig.de/ws/swagger-ui.html).
that will return a specified number of example German sentences for a given German word. 
 
 Below is an example PHP class invokes this API. It is implemented with the help of [Guzzle, HTTP Client.](https://docs.guzzlephp.org/en/stable/).

```php
<?php
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException as RequestException;

include "vendor/autoload.php";

/*
 * This class uses the free Uiv. of Leipzig Sentences Corpus REST API. Example RESTful API url with query paraemters:
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

   private $uri; 

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

```

## Deepl Free API

## Free Deepl API Documentation

Deepl API Documentation [online](https://www.deepl.com/docs-api).

### Translation Request Parameters

Online documentation of Deepl [Request Parameters](https://www.deepl.com/docs-api/translating-text/request/).


+-----------------+--------------+-------------------------------------------------+
| Parameter       | Optional     | Description                                     |
|                 |              |                                                 |
+==================+==============+================================================+
| text            | Required     | Text to be translated. Only UTF8-encoded plain  |
|                 |              | text is supported. The parameter may be         |
|                 |              | specified multiple times and translations are   |
|                 |              | returned in the same order as they are          |
|                 |              | requested. Each of the parameter values may     |
|                 |              | contain multiple sentences. Up to 50 texts can  |
|                 |              | be sent for translation in one request.         |
+-----------------+--------------+-------------------------------------------------+
| source\_lang    | Optional     | Language of the text to be translated. Options  |     
|                 |              | currently available:                            |
|                 |              |                                                 |
|                 |              | -   \"BG\" - Bulgarian                          |
|                 |              |                                                 |
|                 |              | -   \"CS\" - Czech                              |
|                 |              |                                                 |
|                 |              | -   \"DA\" - Danish                             |
|                 |              |                                                 |
|                 |              | -   \"DE\" - German                             |
|                 |              |                                                 |
|                 |              | -   \"EL\" - Greek                              |
|                 |              |                                                 |
|                 |              | -   \"EN\" - English                            |
|                 |              |                                                 |
|                 |              | -   \"ES\" - Spanish                            |
|                 |              |                                                 |
|                 |              | -   \"ET\" - Estonian                           |
|                 |              |                                                 |
|                 |              | -   \"FI\" - Finnish                            |
|                 |              |                                                 |
|                 |              | -   \"FR\" - French                             |
|                 |              |                                                 |
|                 |              | -   \"HU\" - Hungarian                          |
|                 |              |                                                 |
|                 |              | -   \"IT\" - Italian                            |
|                 |              |                                                 |
|                 |              | -   \"JA\" - Japanese                           |
|                 |              |                                                 |
|                 |              | -   \"LT\" - Lithuanian                         |
|                 |              |                                                 |
|                 |              | -   \"LV\" - Latvian                            |
|                 |              |                                                 |
|                 |              | -   \"NL\" - Dutch                              |
|                 |              |                                                 |
|                 |              | -   \"PL\" - Polish                             |
|                 |              |                                                 |
|                 |              | -   \"PT\" - Portuguese (all Portuguese         |
|                 |              |     varieties mixed)                            |
|                 |              |                                                 |
|                 |              | -   \"RO\" - Romanian                           |
|                 |              |                                                 |
|                 |              | -   \"RU\" - Russian                            |
|                 |              |                                                 |
|                 |              | -   \"SK\" - Slovak                             |
|                 |              |                                                 |
|                 |              | -   \"SL\" - Slovenian                          |
|                 |              |                                                 |
|                 |              | -   \"SV\" - Swedish                            |
|                 |              |                                                 |
|                 |              | -   \"ZH\" - Chinese                            |
|                 |              |                                                 |
|                 |              | If this parameter is omitted, the API will      |
|                 |              | attempt to detect the language of the text and  |
|                 |              | translate it.                                   |
+-----------------+--------------+-------------------------------------------------+
| target\_lang    | Required     | The language into which the text should be      |     
|                 |              | translated. Options currently available:        |
|                 |              |                                                 |
|                 |              | -   \"BG\" - Bulgarian                          |
|                 |              |                                                 |
|                 |              | -   \"CS\" - Czech                              |
|                 |              |                                                 |
|                 |              | -   \"DA\" - Danish                             |
|                 |              |                                                 |
|                 |              | -   \"DE\" - German                             |
|                 |              |                                                 |
|                 |              | -   \"EL\" - Greek                              |
|                 |              |                                                 |
|                 |              | -   \"EN-GB\" - English (British)               |
|                 |              |                                                 |
|                 |              | -   \"EN-US\" - English (American)              |
|                 |              |                                                 |
|                 |              | -   \"EN\" - English (unspecified variant for   |
|                 |              |     backward compatibility; please select EN-GB |
|                 |              |     or EN-US instead)                           |
|                 |              |                                                 |
|                 |              | -   \"ES\" - Spanish                            |
|                 |              |                                                 |
|                 |              | -   \"ET\" - Estonian                           |
|                 |              |                                                 |
|                 |              | -   \"FI\" - Finnish                            |
|                 |              |                                                 |
|                 |              | -   \"FR\" - French                             |
|                 |              |                                                 |
|                 |              | -   \"HU\" - Hungarian                          |
|                 |              |                                                 |
|                 |              | -   \"IT\" - Italian                            |
|                 |              |                                                 |
|                 |              | -   \"JA\" - Japanese                           |
|                 |              |                                                 |
|                 |              | -   \"LT\" - Lithuanian                         |
|                 |              |                                                 |
|                 |              | -   \"LV\" - Latvian                            |
|                 |              |                                                 |
|                 |              | -   \"NL\" - Dutch                              |
|                 |              |                                                 |
|                 |              | -   \"PL\" - Polish                             |
|                 |              |                                                 |
|                 |              | -   \"PT-PT\" - Portuguese (all Portuguese      |
|                 |              |     varieties excluding Brazilian Portuguese)   |
|                 |              |                                                 |
|                 |              | -   \"PT-BR\" - Portuguese (Brazilian)          |
|                 |              |                                                 |
|                 |              | -   \"PT\" - Portuguese (unspecified variant    |
|                 |              |     for backward compatibility; please select   |
|                 |              |     PT-PT or PT-BR instead)                     |
|                 |              |                                                 |
|                 |              | -   \"RO\" - Romanian                           |
|                 |              |                                                 |
|                 |              | -   \"RU\" - Russian                            |
|                 |              |                                                 |
|                 |              | -   \"SK\" - Slovak                             |
|                 |              |                                                 |
|                 |              | -   \"SL\" - Slovenian                          |
|                 |              |                                                 |
|                 |              | -   \"SV\" - Swedish                            |
|                 |              |                                                 |
|                 |              | -   \"ZH\" - Chinese                            |
+-----------------+--------------+-------------------------------------------------+
| split\_sentences| Optional     | Sets whether the translation engine should      |         
|                 |              | first split the input into sentences. This is   |
|                 |              | enabled by default. Possible values are:        |
|                 |              |                                                 |
|                 |              | -   \"0\" - no splitting at all, whole input is |
|                 |              |     treated as one sentence                     |
|                 |              |                                                 |
|                 |              | -   \"1\" (default) - splits on punctuation and |
|                 |              |     on newlines                                 |
|                 |              |                                                 |
|                 |              | -   \"nonewlines\" - splits on punctuation      |
|                 |              |     only, ignoring newlines                     |
|                 |              |                                                 |
|                 |              | For applications that send one sentence per     |
|                 |              | text parameter, it is advisable to set          |
|                 |              | split\_sentences=0, in order to prevent the     |
|                 |              | engine from splitting the sentence              |
|                 |              | unintentionally.                                |
+-----------------+--------------+-------------------------------------------------+
| preserve\_format| Optional     | Sets whether the translation engine should      |ting         
|                 |              | respect the original formatting, even if it     |
|                 |              | would usually correct some aspects. Possible    |
|                 |              | values are:                                     |
|                 |              |                                                 |
|                 |              | -   \"0\" (default)                             |
|                 |              |                                                 |
|                 |              | -   \"1\"                                       |
|                 |              |                                                 |
|                 |              | The formatting aspects affected by this setting |
|                 |              | include:                                        |
|                 |              |                                                 |
|                 |              | -   Punctuation at the beginning and end of the |
|                 |              |     sentence                                    |
|                 |              |                                                 |
|                 |              | -   Upper/lower case at the beginning of the    |
|                 |              |     sentence                                    |
+-----------------+--------------+-------------------------------------------------+
| formality       | Optional     | Sets whether the translated text should lean    |  
|                 |              | towards formal or informal language. This       |
|                 |              | feature currently only works for target         |
|                 |              | languages **\"DE\" (German), \"FR\" (French),   |
|                 |              | \"IT\" (Italian), \"ES\" (Spanish), \"NL\"      |
|                 |              | (Dutch), \"PL\" (Polish), \"PT-PT\", \"PT-BR\"  |
|                 |              | (Portuguese) and \"RU\" (Russian)**.Possible    |
|                 |              | options are:                                    |
|                 |              |                                                 |
|                 |              | -   \"default\" (default)                       |
|                 |              |                                                 |
|                 |              | -   \"more\" - for a more formal language       |
|                 |              |                                                 |
|                 |              | -   \"less\" - for a more informal language     |
+-----------------+--------------+-------------------------------------------------+
| glossary\_id    | optional     | specify the glossary to use for the             |
|                 |              | translation. **important:** this requires the   |
|                 |              | source\_lang parameter to be set and the        |
|                 |              | language pair of the glossary has to match the  |
|                 |              | language pair of the request.                   |
+-----------------+--------------+-------------------------------------------------+

### Extended Parameters

The following extended parameters are also available. Please refer to
the \"Handling XML\" section below for further information on how to use
these parameters.
                            
+----------------------+--------------+-------------------------------------------------+
| Parameter            | Optional     | Description                                     |
|                      |                                                                |
+======================+==============+=================================================+
| tag\_handling        | Optional     | Sets which kind of tags should be handled.      |
|                      |              | Options currently available:                    |
|                      |              | -   \"xml\"                                     |
|                      |              |                                                 |
|                      |              
+----------------------+--------------+-------------------------------------------------+
| non\_splitting\_tags | Optional     | Comma-separated list of XML tags which never    |
|                      |              | split sentences.                                |
|                      |              |                                                 |
+----------------------+--------------+-------------------------------------------------+
| outline\_detection   | Optional     | Please see the \"Handling XML\" section for     |
|                      |              | further details.                                |
|                      |              |                                                 |
+----------------------+--------------+-------------------------------------------------+
| splitting\_tags      | Optional     | Comma-separated list of XML tags which always   |
|                      |              | cause splits.                                   |
|                      |              |                                                 |
+----------------------+--------------+-------------------------------------------------+
| ignore\_tags         | Optional     | Comma-separated list of XML tags that indicate  |
|                      |              | text not to be translated.                      |
+----------------------+--------------+-------------------------------------------------+

Prospective Github.com PHP Deepl repsitories:

This github repository uses PHP and Guzzle

- [Deepl-Client](https://github.com/tinyappsde/deepl-client)

## Azure Translation Service


## IBM Cognitive Services Translation Servoce

</div>
