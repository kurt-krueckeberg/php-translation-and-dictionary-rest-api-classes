# TODO

## Design

Try a hybrid approach, where fixed, preset values are in the XML file, but where any extra computation like computing the string input length is in s derived class?
The drived class constructor will call the base class constructor, which will processi the XML period. 

If another translator like the IBM translator requires a speical authorization authorization using a special authorization method,like Digest, then the action melt
xml can be modified to accommodate an <authorization><method>digest</method></authorizaion>. This might simply be handled as a preset header name and value as with Azure
Translator.

### Coomments on Use of Guzz;e:

#### Hanlders

Look into the Guzzle Hanlders and Middlewares. Hanldeer and "handle" request options, whic means about anything from headers to query string parms.

I'm not sure what Middleware  means or does?

Guzzle may set "json" may be the default setting to the Content-Type header. See [doc](https://docs.guzzlephp.org/en/stable/request-options.html#json)

### body xoption 

It can be set [three ways](https://docs.guzzlephp.org/en/stable/request-options.html#body).

### Setting Headers

See [doc](https://docs.guzzlephp.org/en/stable/request-options.html#headers)


You can add an handler when the **body** during `prepare_body`



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
