<section>

# TODO

## Alternate Javasrcript Design

Using jvavscript [Fetch API](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API)

## Design

Understand what the PHP PSR-7 HTTP Message-related interfaces actually represent. What is an HTTP Message (according to the aqppropo RFC standard), how are they repsetnted and 
how do the PHP classes capture this. Guzzle's Request object implements RequestInterface, so understanding how to use the RequestInterface will give us they
flexibiilty of designing a general Translator class (that will work for IBM, Azure, DEEPL and any others). This general implementation may beneift from design pattern like Template Method.

It will also help to undertand how HTTP message authentication works.

See the bookmarks PHP Bookmarks and the documentation on [Guzzle and PSR-7](https://docs.guzzlephp.org/en/stable/psr7.html)

### Coomments on Use of Guzzle:

[Guzzle Request Options](https://docs.guzzlephp.org/en/stable/request-options.html) can be set on the ctor or a Request object:

 - [Authorization](https://docs.guzzlephp.org/en/stable/request-options.html#auth)

 - [headers](https://docs.guzzlephp.org/en/stable/request-options.html#headers)

 - [body](???)

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
