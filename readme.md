# Documentation 

**Note:** The code is working but in beta. 

## Overview

This code generates German example sentences, using the University of [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en), and translates them into your target language. The input is file with a list of words ( one word per line). To use it you must have either a DEEPL account or a Microsoft Azure account.

**Note:** The [Leipzig Corpora Collection](https://wortschatz.uni-leipzig.de/en) provides example sentences in other languages besides German.

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

2. Modify [main.php](main.php) to your needs. Changing the call to `Translator::createFromXML("config.xml", "d");` to use your translator of choice (either **m** for Microsfot Azure Translator or **d** for DEEPL):

| Provider | Abbreviation | XML `<provider>` node |
|----------|--------------|-------------------| 
| DEEPL| d | `<provider name="deepl" abbrev="d">` |          
| Microsoft Azure Translator| m | `<provider name="Azure" abbrev="m">` |
| IBM Watson Translator(not yet implemented)| i |  `<provider name="IBM" abbrev="i">` | 

3. Call `Translator:: translate(string $text, string $dest_lang, $source_lang="");`

   If the source language (the 2nd paramter) is omitted, the input language will be detected.
## PHP Classes

The configuration is an XML-driven set of translation classes for issuing REST translation calls to [DEEPL](https://www.deepl.com/docs-api), [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)
and [IBM Watson Translator](https://cloud.ibm.com/docs/language-translator/getting-started.html#gettingstarted) (not yet implemnted). Client code uses the base class `Translator` class that implements `TranslatorInterface`.

The REST client used in the implementation is [Guzzle](https://docs.guzzlephp.org/en/stable/).

**Note:** The code is working but in beta. The IBM Watson Translator class is not yet implemented.

- `SentenceFetcher` is the REST client for the Universität von Leipzig (Univeristy of Leipzig) sentence corpus. The default sentence corpus (found in the `<route>` element in sample-cofig.xml) is `deu_news_2012_1M`. 

- `Translator`is the base translator class tthat client code will instantiate using the `Translator::createFromXML(\SimpleXMLElement $xml, string $abbrev)` method.

- `PonsDictionary` is not yet implement. It is the REST client for the PONS dictionary API, which has a quote of 1,000 queries per month.
