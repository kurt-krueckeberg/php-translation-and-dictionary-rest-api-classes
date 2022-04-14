# Documentation 

**Note:** The code is working but in beta. 

## Overview

This code generates German example sentences and translates them into your target language. The input is file with a list of words ( one word per line). To use it you must have either a DEEPL account or a Microsoft Azure account.

## Requriements

It uses:

- the REST API of the University of Leipzig Corpora Collection (which is free)

- [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/) (which is not free)

- [DEEPL](https://www.deepl.com/docs-apiD) Trranslator (which has free version with a limited monthly quota)

## Comments

**Note:** The code is working but in beta.  The IBM Watson Translator class is not yet implemented.

The configuration is XML-driven set of translation classes for issuing REST translation calls to [DEEPL](https://www.deepl.com/docs-api), [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)
and [IBM Watson Translator](https://cloud.ibm.com/docs/language-translator/getting-started.html#gettingstarted) (not yet implemnted). Client code uses the base class `Translator` class that implements `TranslatorInterface`.

The underlying REST client (in the implementation) is [Guzzle](https://docs.guzzlephp.org/en/stable/).

Usage:

After cloing the repository:

1. Generate the autoloader using **composer**:

```bash
$ composer dump-autoload
```

Add your **DEEPL** and **Azure Translator** keys to **sample-config.xml**, and rename it **config.xml**. If you are using the Pro version of DEEPL, change the DEEPL `<baseurl>` in config.xml.

2. Modify [main.php](main.php) to your needs. Changing the call to `Translator::createFromXML("config.xml", "d");` to use your translator of choice (either **m** for Microsfot Azure Translator or **d** for DEEPL):

| Provider | Abbreviation | XML `<provider>` node |
|----------|--------------|-------------------| 
| DEEPL| d | `<provider name="deepl" abbrev="d">` |          
| Microsoft Azure Translator| m | `<provider name="Azure" abbrev="m">` |
| IBM Watson Translator(not yet implemented)| i |  `<provider name="IBM" abbrev="i">` | 

3. Call `Translator:: translate(string $text, string $dest_lang, $source_lang="");`

   The default source language, if specified in config.xml, will be used; otherwise, it will be auto-detected.

The various REST translators can automatically detect the source (input) language, but you can alos set a default source language in `config.xml`.
