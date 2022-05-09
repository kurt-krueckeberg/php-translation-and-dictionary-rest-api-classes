# PHP Translation and Dictionary REST API Classes

## Classes

### Translation and Dictionary lookup 

- `AzureTranslator`

   Also contains an `examples` method to return example phrases for a definition.

- `SystranTranslator`

   Many definition are accompanied with example expressions.

-  `RestClient`

    Base class with static factory method 

- `LeipzipSentenceFetcher`

   Returns example sentences

## PHP 8.1 Comments

This code requires PHP 8.1 because it uses:

- an Enumeration that also implements an interface

- readonly class properties that are promoted to class members on the constructor.

- `new` expressions in class constructors to create objects as default constructor parameters.

- **intersection type** function parameter declarations to allow `DictionaryInterface & TranslationInterface` parameters in client code. 

- fist-class `callable` syntax

## Installion

After cloing the repository:

```bash
$ composer update 
$ composer dump-autoload
````

## Usage

See [main.php](main.php) 

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
}

class AzureTranslator extends RestClient implements DictionaryInterface, TranslateInterface {

   __construct(AzureConfig c = new AzureConfig)
   
   getTranslationLanguages() : array

   getDictionaryLanguages() : array 
    
   translate(string text, string dest_lang, source_lang="") : string 
   
   lookup(string word, string src_lang, string dest_lang) : array 

   examples(string word, array translations) : ResultsIterator
}

class DeeplTranslator extends RestClient implements TranslateInterface {
   
   __construct(DeeplConfig c = new DeeplConfig)
   
   getLanguages() : string

   getSourceLanguages() : array

   getTargetLanguages() : array
   
   getTranslationLanguages() : array

   translate(string text, string dest_lang, source_lang="") : string 
}

class SystranTranslator extends RestClient implements DictionaryInterface, TranslateInterface {

   __construct(AzureConfig c = new SystranConfig)
   
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
