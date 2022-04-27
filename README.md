# PHP Translation and Dictionary REST API Classes

This code requires PHP 8.1 because it uses:

- an Enumeration (that also implements an interface)

- readonly class properties (that are assigned and promoted to class members on the constructor).

- `new` expressions in class constructors (to create objects as default constructor parameters).

## UML Diagrams

### Translaton and Dictionary Interfaces and Classes

Click on the UML [Dictionary and Translation classes and Interfaces](/assets/images/dict-trans-classes.png) diagram below to enlarge it.

![UML Dictionary and Translation Class and Interface Diagram](/assets/images/dict-trans-classes.png)

The dictionary and translation classes and interfaces (in UML) are:

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

### Example Sentences Interfaces and Classes

Click on the UML [Example Sentences Interfaces and Classes](/assets/images/sentence-fetcher.png) diagram below to enlarge it.

![UML of Examples Sentence Retrieval Class and Interface Diagram](/assets/images/sentence-fetcher.png)

The example-sentences retrieval interfaces and classes (in UML) are:

```plantuml
interface SentenceFetchInterface  { 

   fetch(string word, int count=3) : ResultsIterator;
}

class UniLeipzigSentenceFetcher extends RestClient implements SentenceFetchInterface {

   __construct( UniLeipzigConfig c = new UniLeipzigConfig() )
   
   fetch(string word, int count=3) :  ResultsIterator
}
```

## Usages

todo: complete this.
