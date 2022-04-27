# PHP Translation and Dictionary REST API Classes

This code requires PHP 8.1 because it uses:

- an Enumeration (that also implements an interface)

- readonly class properties (that are assigned and promoted to class members on the constructor).

- `new` expressions in class constructors (to create objects as default constructor parameters).

- intersection types function parameter declarations to accept `DictionaryInterface & TranslationInterface`
  For us in the client code to accept classes that implement both of these interfaces.

## Usage

todo: complete this.

## Implementation

### Translaton and Dictionary Interfaces and Classes

The UML [Dictionary and Translation classes and Interfaces](/assets/images/dict-trans-classes.png) diagram (click to enlarge).

![UML Dictionary and Translation Class and Interface Diagram](/assets/images/dict-trans-classes.png)

The dictionary and translation classes and interfaces in UML are:

```plantuml
interface TranslateInterface {

   public function translate(string str, string dest_lang, string src_lang="") : string; 
   public function getTranslationLanguages() : array;
}

interface DictionaryInterface {
   
   lookup(string str, string src_lang, string dest_lang) : string |array|ResultsIterator; 

   getDictionaryLanguages() : array;
}

class AzureTranslator extends RestClient implements DictionaryInterface, TranslateInterface {

   __construct(AzureConfig c = new AzureConfig)
   
   getTranslationLanguages() : array

   getDictionaryLanguages() : array 
    
   translate(string text, string dest_lang, source_lang="") : string 
   
   function lookup(string word, string src_lang, string dest_lang) : string 
}

class DeeplTranslator extends RestClient implements TranslateInterface {
   
   __construct(DeeplConfig c = new DeeplConfig)
   
   getLanguages() : string

   getSourceLanguages() : array

   getTargetLanguages() : array
   
   getTranslationLanguages() : array

   translate(string text, string dest_lang, source_lang="") : string 
}

class PonsDictionary extends  RestClient implements DictionaryInterface {

   __construct(PonsConfig c = new PonsConfig)

   getDictionaryLanguages() : array 

   getDictionaryForLanguages(string lang) : array

   lookup(string text, string src, string dest) : ResultsIterator
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

class UniLeipzigSentenceFetcher extends RestClient implements SentenceFetchInterface {

   __construct( UniLeipzigConfig c = new UniLeipzigConfig() )
   
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
```
