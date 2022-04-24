# Documentation 

Code tested against PHP 8.1 only. See [main.php](main.php) for example code.

## Overview

This code generates German example sentences, using the University of [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en), and translates them into the target language. 
The input is file with a list of words (one word per line). To use it, you must have either a DEEPL account or a Microsoft Azure account. Other cloud-base translators may be added later.

**Note:** The [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en) provides example sentences in other languages besides German.

Dictionary classes are also available.

## Requirements

It uses:

- the REST API of the University of [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en),  which is free (although somewhat slow).

- [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/) (which is free only for one month with a new account, afterward you must get a paid subscription).

- [DEEPL](https://www.deepl.com/docs-apiD) Translator. There is a free version with a limited monthly quota and a Pro paid version.

- PONS Dictionary API.

  Note: If you have the Pro paid version, you must change the DEEPL endpoint in the `<baseurl>` element of config.xml. It currently has the free endpoint.

## Installation

After cloing the repository:

1. Install the requirement and generate the autoloader using **composer**:

```bash
$ composer update 
$ composer dump-autoload

Add your **DEEPL** and/or **Azure Translator** keys to **sample-config.xml**, and rename it **config.xml**. If you are using the Pro version of DEEPL, change the DEEPL `<baseurl>` in config.xml.

``

## PHP Classes and Interfaces

All interfaces and classes are in the `LanguageTools` namespace.

### interfaces

```php
interface TranslateInterface {

    // todo: Should this return an \Iterator or \ArrayIterator?
   public function translate(string $str, string $dest_lang, string $src_lang="") : string; 
}

interface DictionaryInterface {
   
   /*
    todo: 
     What is the best retun type; ResultsIterator | array | string?
    */
   public function lookup(string $str, string $src_lang, string $dest_lang) : string |array; 
}

interface LanguagesSupportedInterface {

   // todo: string is probably not the best return type. Array or stdClass probably is.
   public function getLanguages() : string;
}

interface SentenceFetchInterface  { 

   public function fetch(string $word, int $count=3) : ResultsIterator;
}


```

### Classes

- `RestClient` is the base class of all the REST implementation classes

   Use its static factory method `function createRestClient(LanugageTools\ClassId $id)` to instantiate
   implementation classes.

- abstract class `TranslatorWithDictionary` implements both `TranslateInterface` and `DictionaryInterface`
  and extends `RestClient`. It contains no implementations. It is an "interface" that clients can use.

```php
abstract class TranslatorWithDictionary extends RestClient implements TranslateInterface,
               DictionaryInterface { }
```

#### Implementation Classes

**todo:** Describe these classes

