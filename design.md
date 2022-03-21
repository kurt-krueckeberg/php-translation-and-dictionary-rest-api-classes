<section>

# TODO

## Design

Azure's **Translator version 3.0** supports more than just text translation, while Deepl only supports text translation. I'm not sure if IBM Watson supports more than just text 
translation. All the REST APIs have requirements for:

- baseurl

- Supported request type: 
  - translation
  - dictionary lookup
  - etc

- For each supported translation service above, what are the API details:
 
  - POST or GET HTTP method? 
  - URL "route" that is appened to endpoint
  - means of authentication--header or query string parameter--and details.
  - required headers
  - query string parameters
  - Is input text in request body data and its format (json encoded most likely), or is it a query parameter?
  - format of request 
  - failure error codes
  - format of returned response
  - etc

Generalize the .xml configuration to capture the requires of each.
 
### PHP PS-7 Message Interfaces

- PHP's [Http PS-7 Interfaces](https://www.dotkernel.com/how-to/what-is-psr-7-and-how-to-use-it/).
- [Guzzle and PSR-7](https://docs.guzzlephp.org/en/stable/psr7.html)

### Azure Translator Questions

Does Azure Translator 3.0 actually require the **Content-Length** header? The Translator 3.0 [Quick Start](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator)

For text translation requrest, where does is say "the following limitations apply to the json array with the input text:"

    The array can have at most 100 elements.
    The entire text included in the request cannot exceed 10,000 characters including spaces.


It is unclear if Content-Length is really required because the 

You can get character counts for both source text and translation output using the translate endpoint. To return sentence length (srcSenLen and transSenLen) you must set the includeSentenceLength parameter to True.
Change design of Transltor-devied ctors? or prepare\_request?:

-  Add this query sring setting to request, OR 
-  Do it in the ctro, or
- Create and return the Request object here. 

### Coomments on Use of Guzzle:

[Guzzle Request Options](https://docs.guzzlephp.org/en/stable/request-options.html) can be set on the ctor or a Request object:

 - [Authorization](https://docs.guzzlephp.org/en/stable/request-options.html#auth)

 - [headers](https://docs.guzzlephp.org/en/stable/request-options.html#headers)

#### Hanlders

Maybe look into the Guzzle hanlders and middlewares. Do they allow a sort of "override" or late-setup of how headers to query string parms are set?

Check if Guzzle usesd "application/json" ase the default setting for Content-Type (header). See [doc](https://docs.guzzlephp.org/en/stable/request-options.html#json)

### body option 

The request body evidently can be set [three ways](https://docs.guzzlephp.org/en/stable/request-options.html#body).
Does Guzzle allow you to add an handler to handle preparing the request body. Is this even important?

### Setting Headers

See the various ways headers can be  [set](https://docs.guzzlephp.org/en/stable/request-options.html#headers)

## XML

[XML Tutorial](https://www.w3schools.com/xml/)

## Understanding XPath Queries

- W3School [XPath Tutorial](https://www.w3schools.com/xml/xpath_nodes.asp)   	
- [XPath tutorial](https://www.softwaretestinghelp.com/xml-path-language-xpath-tutorial/)
- [XPath Tutorial](https://www.educba.com/xml-features/?source=leftnav)
- [Getting Started with XPath](https://riptutorial.com/xpath) is Exellent!

  - [Find all elements with certain text](https://riptutorial.com/xpath/example/6209/find-all-elements-with-certain-text)

PHP's SimpleXMLElement has an xpath() function.

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

</section>
