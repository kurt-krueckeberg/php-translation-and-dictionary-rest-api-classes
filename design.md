# TODO

## Design

Make the XML entries "precisely" (at least do a 'first darft') reflect the respective API tranlation service's pecifications.
In  the process, try to:

- Better understand how to design XML.
- Understand requirements of each translation service in terms of what is required for each api call. 
- What is common across services, what differs and how?
- Make code driven by the xml settings as unintelligent as possible.

The goal is xml-driven that will be put in Translator.php code, and the elimnation of GuzzleAPIWrapper entirely.

### Examples

```xml
<authentication means="header">
  <key>          </key>
</authentication>
```

```xml
<authentication means="query">
  <key>          </key>
</authentication>
```

```xml
<queryString>
  <parm order="first">
    <name>Key</name>
    <value>
```

```xml
<parms>
 <parm type="header">
   <name>api-key</name>
   <preset>3.0</preset>
 <parm type="query">
 //....
</parms>
```

```xml
<parms>
 <preset>
   <heeader>...
   </header>
   <query>
   </query>
 </prest>
```

## XML

[XML Tutorial](https://www.w3schools.com/xml/)

## Understanding XPath Queries

- W3School [XPath Tutorial](https://www.w3schools.com/xml/xpath_nodes.asp)   	
- [XPath tutorial](https://www.softwaretestinghelp.com/xml-path-language-xpath-tutorial/)
- [XPath Tutorial](https://www.educba.com/xml-features/?source=leftnav)
- [Getting Started with XPath](https://riptutorial.com/xpath) is Exellent!

  - [Find all elements with certain text](https://riptutorial.com/xpath/example/6209/find-all-elements-with-certain-text)

PHP's SimpleXMLElement has an xpath() function.

## Guzzle

[Guzzle Request Options](https://docs.guzzlephp.org/en/stable/request-options.html) can be set on the ctor or a Request object:

 - [Authorization](https://docs.guzzlephp.org/en/stable/request-options.html#auth)

 - [headers](https://docs.guzzlephp.org/en/stable/request-options.html#headers)

## Azure Translator

### My Azure Settings

 ------------------------------------------------------------------
 Setting          Value
 ---------------- -------------------------------------------------
 location         eastus2
                
 key1             ef6e5b44c68d438c8d79cae2f8c020ba
                
 key2             a3c9c437de3b43a7a93f707a71740af6

 Translation\     https://api.cognitive.microsofttranslator.com/
 url        
 ---------------- -------------------------------------------------

[Azure Translator 3.0 Documentation](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-reference)

### Translation Implementaqtions in PHP

  - Microsoft's [owm implmentation in PHP](https://github.com/MicrosoftTranslator/Text-Translation-API-V3-PHP/blob/master/Translate.php)

  - [Matthisan Noback's code](https://github.com/matthiasnoback/microsoft-translator)
    - Mainly just the file [Tranlate.php](https://github.com/matthiasnoback/microsoft-translator/blob/master/src/MatthiasNoback/MicrosoftTranslator/ApiCall/Translate.php)

  - [CURL Implementation](https://www.aw6.de/azure/)

## Modern AJAX

- [Making HTTP Requests from Javascript](https://drstearns.github.io/tutorials/ajax/)

- [AJAX with Fetch or with XHR](https://code.tutsplus.com/en/articles/create-a-javascript-ajax-post-request-with-and-without-jquery--cms-39195)

- [Five Ways to Make HTTP Requests in PHP](https://www.twilio.com/blog/5-ways-to-make-http-requests-in-php)

## PHP Composer

- Make this repositories composer-compliant, so that you can install it using composer and autoload its classes. 

  - [Composer Package Management](https://whoisryosuke.com/blog/2018/how-to-create-a-php-package-for-composer/)
 
  - [Packagist The PHP Package Repository](https://packagist.org/)
