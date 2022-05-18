# PHP Translation and Dictionary REST API Classes

## Classes

### Translation and Dictionary lookup 

- `AzureTranslator`

   Implements `TranlateInterface` and `DictionaryInterface` and also contains the `examples(string $word, ResultsIterator $definitions)` method that return example phrases (for each given definition)

- `SystranTranslator`

   Implements `TranlateInterface` and `DictionaryInterface`. Its `DiciontaryIntrface::lookup` method  often returns example phrases.

-  `RestClient`

    Base class with static factory method `RestClient::createClient(ClassID id)`. 

- `LeipzipSentenceFetcher`

   Implements 'SentenceFetchInerface` whose 'fetch` method Returns example sentences

## PHP 8.1 Comments

This code requires PHP 8.1 because it uses:

- enumerations (that implement interfaces).

- function methods paramters that take Intersction Types of `DiciontaryInterface|TranslateInterface`

- First-class callable syntax


## Installion

After cloing the repository:

```bash
$ composer update 
$ composer dump-autoload
````

## Usage

For usage see [main.php](main.php) 

## Implementation

### Translaton and Dictionary Interfaces and Classes

The UML [Dictionary and Translation classes and Interfaces](/assets/images/dict-trans-classes.png) diagram (click to enlarge).

![UML Dictionary and Translation Classes and Interface Diagram](/assets/images/dict-trans-classes.png)

The dictionary and translation classes and interfaces in UML are:

```plantuml
interface TranslateInterface {

   public function translate(string $str, string $dest_lang, string $src_lang="") : string;
   public function getTranslationLanguages() : array;
}

interface DictionaryInterface {
   
   public function lookup(string $str, string $src_lang, string $dest_lang) : array|ResultsIterator; 
   public function getDictionaryLanguages() : array; 
}

class RestClient {

   static createRestClient(ClassID $id) : mixed
   __construct(ClassID id)
}

class AzureTranslator extends RestClient implements DictionaryInterface, TranslateInterface {

   __construct(ClassID id)
   
   getTranslationLanguages() : array

   getDictionaryLanguages() : array 
    
   translate(string text, string dest_lang, source_lang="") : string 
   
   lookup(string word, string src_lang, string dest_lang) : ResultsIterator

   examples(string word, array translations) : ResultsIterator
}

class DeeplTranslator extends RestClient implements TranslateInterface {
   
   __construct(ClassID id)
   
   getLanguages() : string

   getSourceLanguages() : array

   getTargetLanguages() : array
   
   getTranslationLanguages() : array

   translate(string text, string dest_lang, source_lang="") : string 
}

class SystranTranslator extends RestClient implements DictionaryInterface, TranslateInterface {

   __construct(ClassID id)
   
   getTranslationLanguages() : array

   getDictionaryLanguages() : array 
    
   translate(string text, string dest_lang, source_lang="") : string 
   
   lookup(string $word, string $src_lang, string $dest_lang) : ResultsIterator
}
```

### Example Sentences Retrieval Interface and Class

The UML [Example Sentences Interfaces and Classes](/assets/images/sentence-fetcher.png) diagram.

![UML of Examples Sentence Retrieval Class and Interface Diagram](/assets/images/sentence-fetcher.png)

The example sentences retrieval interfaces and classes in UML are:

```plantuml
interface SentenceFetchInterface  { 

   fetch(string word, int count=3) : ResultsIterator;
}

class RestClient {

   static createRestClient(ClassID $id) : mixed
}

class LeipzigSentenceFetcher extends RestClient implements SentenceFetchInterface {

   __construct( UniLeipzigConfig c = new LeipzigConfig() )
   
   fetch(string word, int count=3) :  ResultsIterator
}
```

### ResultsIterator Class

The UML diagram of the [ResultsIterator class](/assets/images/results-iterator.png).

![UML of ResultIterator](/assets/images/results-iterator.png)

The `ResultsIterator` constructor accepts a `callable` parameter that is invoked whenever an element (in the contained array) is returned as a result of 
`current()` , `OffsetSet` or `OffsetGet` being called.

The example sentences retrieval interfaces and classes in UML are:

```plantuml
class ResultsIterator implements  \SeekableIterator, \ArrayAccess, \Countable {

     __construct(array $objs, callable $func) 
    
    offsetSet($offset, $value) : void

    offsetExists($offset) : bool

    offsetUnset($offset) : void

    offsetGet($offset) : mixed

    count(): int

    seek(int $offset) : void 
   
    current(): mixed

    key(): mixed

    next(): void

    rewind(): void

    valid(): bool
}
class  SystranDictResult {

 __construct(public readonly string term,
              public readonly string pos,
              public readonly array definitions) 
	      
}
```
