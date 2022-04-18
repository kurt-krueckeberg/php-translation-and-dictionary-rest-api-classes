# Documentation 

Documentation is not complete or up to date. See [main.php](main.php) for example code.

## Overview

This code generates German example sentences, using the University of [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en), and translates them into your target language. The input is file with a list of words ( one word per line). To use it you must have either a DEEPL account or a Microsoft Azure account.

**Note:** The [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en) provides example sentences in other languages besides German.

Dictionary classes are also available.

## Requirements

It uses:

- the REST API of the University of [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en),  which is free (although somewhat slow).

- [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/) (which is free only for one month with a new account, afterward you must get a paid subscription).

- [DEEPL](https://www.deepl.com/docs-apiD) Translator. There is a free version with a limited monthly quota and a Pro paid version.

  Note: If you have the Pro paid version, you must change the DEEPL endpoint in the `<baseurl>` element of config.xml. It currently has the free endpoint.

## Installation

After cloing the repository:

1. Generate the autoloader using **composer**:

```bash
$ composer update 
$ composer dump-autoload
```

Add your **DEEPL** and/or **Azure Translator** keys to **sample-config.xml**, and rename it **config.xml**. If you are using the Pro version of DEEPL, change the DEEPL `<baseurl>` in config.xml.

2. Modify [main.php](main.php) to your needs. Changing the call to, for example, `RestClient::createFromXML("config.xml", "d");` to use the DEEPL translator. **d** is the abbreviation for DEEPL and **m** Microsfot Azure Translator.

| Provider | Abbreviation | XML `<provider>` node |
|----------|--------------|-------------------| 
| DEEPL| d | `<provider name="deepl" abbrev="d">` |          
| Microsoft Azure Translator| m | `<provider name="Azure" abbrev="m">` |
| IBM Watson Translator(not yet implemented)| i |  `<provider name="IBM" abbrev="i">` | 

3. Sample code is in [main.php](main.php):

```php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\WebpageCreator;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\SentenceFetchInterface;

include 'vendor/autoload.php';

function check_args(int $argc, array $argv)
{
  if ($argc < 2)
      die ("Enter file with the list of words.\n");

  if (!file_exists($argv[1]))
       die("Input file " . $argv[1] . " does not exist!\n");

  if (!file_exists("config.xml"))
       die("config.xml not found in current directory.\n");
}

function create_html_output(SentenceFetchInterface $fetcher, TranslateInterface $translator, string $fname)
{ 
   $creator = new WebpageCreator();
  
   $file =  new File($fname);

   $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

   //--$translator = RestClient::createRestClient($xml, "m"); 

   foreach ($file as $word) {
  
      $creator->write("<strong>$word</strong>", "<strong>No Definitions (yet)</strong>"); 

      echo "Fetching '$word' examples:\n";

      foreach ( $fetcher->fetch($word, 3) as $sentence) {

           echo "Translating: " . $sentence . "\n";

           // 2nd parameter is destination language. 3rd parameter is optional source language.
           // If 3rd parameter is ommited, source language is automatically detected.
           $translation = $translator->translate($sentence, "EN-US", "DE"); 
           
           $creator->write($sentence, $translation); 
      }
      echo "\n";
   }
}

  check_args($argc, $argv);

  try {

    $xml = \simplexml_load_file("config.xml");
  
    $fetcher = RestClient::createRestClient($xml, "l"); 

    $translator = RestClient::createRestClient($xml, "m"); 

    create_html_output($fetcher, $translator, $argv[1]);

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
```

3. Call `Translator:: translate(string $text, string $dest_lang, $source_lang="");`

   If the source language (the 2nd paramter) is omitted, the input language will be detected.

## PHP Classes and Interfaces

**todo:** complete this.
