<section>

# TODO

## Alternate Javasrcript Design

Using jvavscript [Fetch API](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API)

## Design

Understand:

- [Basics of HTTP](https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP)
- [What HTTP is](https://www.w3schools.com/whatis/whatis_http.asp)
- What an [HTTP Messages](https://developer.mozilla.org/en-US/docs/Web/HTTP/Messages) are.
- What [HTTP Authenication](https://developer.mozilla.org/en-US/docs/Web/HTTP/Authentication) is and how it works.

Understand the PHP HTTP Message interfaces created to represent HTTP messages:

- Concise Summary of all PSR-7 HTTP Message [Interfaces](https://github.com/php-fig/http-message/blob/master/docs/PSR7-Interfaces.md)
- Related [Usage Guide](https://github.com/php-fig/http-message/blob/master/docs/PSR7-Usage.md)

Understamd:

- Guzzle's Request object implements RequestInterface (or ClientInterface, which is also a PSR-7 standard) and a Guzzle-speicific ClientInterface (or is it?).

Consult:

-  [Guzzle and PSR-7](https://docs.guzzlephp.org/en/stable/psr7.html)

The goal is a general Translator or RESTTransltor class that will work for IBM's, Azure's, DEEPL and any others translation services. This general implementation may
beneift from design pattern like Template Method.

## XML

[XML Tutorial](https://www.w3schools.com/xml/)

## Understanding XPath Queries

- W3School [XPath Tutorial](https://www.w3schools.com/xml/xpath_nodes.asp)   	
- [XPath tutorial](https://www.softwaretestinghelp.com/xml-path-language-xpath-tutorial/)
- [XPath Tutorial](https://www.educba.com/xml-features/?source=leftnav)
- [Getting Started with XPath](https://riptutorial.com/xpath) is Exellent!

  - [Find all elements with certain text](https://riptutorial.com/xpath/example/6209/find-all-elements-with-certain-text)

PHP's SimpleXMLElement has an xpath() function.

## Modern AJAX

- [Making HTTP Requests from Javascript](https://drstearns.github.io/tutorials/ajax/)

- [AJAX with Fetch or with XHR](https://code.tutsplus.com/en/articles/create-a-javascript-ajax-post-request-with-and-without-jquery--cms-39195)

- [Five Ways to Make HTTP Requests in PHP](https://www.twilio.com/blog/5-ways-to-make-http-requests-in-php)

## PHP Composer

- Make this repositories composer-compliant, so that you can install it using composer and autoload its classes. 

  - [Composer Package Management](https://whoisryosuke.com/blog/2018/how-to-create-a-php-package-for-composer/)
 
  - [Packagist The PHP Package Repository](https://packagist.org/)

</section>
