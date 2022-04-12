# Documentation 

This is an XML-driven set of translation classes for issuing REST translation calls to [DEEPL](https://www.deepl.com/docs-api), [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)
and [IBM Watson Translator](https://cloud.ibm.com/docs/language-translator/getting-started.html#gettingstarted) (not yet implemnted). Client's use the class `Translator` class that implements `TranslatorInterface`.

The underlying REST client (in the implementation) is [Guzzle](https://docs.guzzlephp.org/en/stable/).

Usage:

1. Generate autoloaded using **composer**:

```bash
$ composer dump-autoload
```

Add your **DEEPL** and **Azure Translator** keys to **sample-config.xml** and rename it **config.xml**.

2. In your code call, for example, `Translator::createFromXML("config.xml", "d");`, where the 2nd paramter is one-letter abbreviation of the provider:

| Provider | Abbreviation | XML `<provider>` node |
|----------|--------------|-------------------| 
| DEEPL| d | `<provider name="deepl" abbrev="d">` |          
| Microsoft Azure Translator| m | `<provider name="Azure" abbrev="m">` |
| IBM Watson Translator | i |  `<provider name="IBM" abbrev="i">` | 

3. Call `Translator:: translate(string $text, string $dest_lang, $source_lang="");`

   The default source language, if specified in config.xml, will be used; otherwise, it will be auto-detected.

## Comments:

The various REST translators can automatically detect the source (input) language, but you can alos set a default source language in `config.xml`.
