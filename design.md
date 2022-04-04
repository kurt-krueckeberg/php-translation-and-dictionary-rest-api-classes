<section>

# TODO

## Alternate Javasrcript Design

Using jvavscript [Fetch API](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API)

## Design

See also: https://php.watch/versions/7.4/typed-properties

Implement each translation service, based on the documentation and curl examples. Later try to generalize the code.

Derived Translator class will override `prepareInput/prepareText()` to insert the text to be translated in the reuqest (in the body or query parameters, etc), to format
it as required--including calling urlendocde()?--as a json object or encode it as a query string paramete).  It will use the methods of the PSR `IRequestInterface` methods
to do so. 


### Guzzle Request objects

`GuzzleHttp\Psr7\Request` constructor 

```php
class Request {

  //...
   public function __construct(string $method,           
        $uri,                     
        array $headers = [],      
        $body = null,        // <-- Don't specify the next two paramaters if only query parameters are used.     
        string $version = '1.1'   
      ) { //...  }
}
```
takes these parameters

|Parameter  | Meaning                              |Types Allowed
|-----------|--------------------------------------|--------------------------------------|
|$method    | HGET, POST, DELETE, etc              | string                               |
|$uri       | route                                | string|UriInterface                  |
|$headers   | headers                              | array<string, string\|string[]>      |
|$body      | request body                         | string|resource|StreamInterface|null |
|$version   | Protocol version (defaults)          | string                               | 

Example code:

```php
// Create a PSR-7 request object to send
$headers = ['X-Foo' => 'Bar'];
$body = 'Hello!';
$request = new Request('HEAD', 'http://httpbin.org/head', $headers, $body);
```	

Examples I found Googleing:

```php
$response = $client->post('the/endpoint', [
  'debug' => TRUE,
  'body' => $payload,
  'headers' => [
    'Content-Type' => 'application/x-www-form-urlencoded',
  ]
]);

$body = $response->getBody();
print_r(json_decode((string) $body));
```

```php
$text =  ['text' => iconv(mb_detect_encoding($query, mb_detect_order(), true), "UTF-8", $query) ];

$body = [
    'json' => $text; // <=======  **NOTE** The use of the key 'json'
];

//  $body is just an array whose key is 'json' and whose value is...encoded json ( I think).
$response = $client->post($path, $body);

$responseBody = $response->getBody();
```
#### Guzzle json Option

The `json` request option [documentation](https://docs.guzzlephp.org/en/stable/request-options.html#json) states:

> The json option is used to easily upload JSON encoded data as the body of a request. A Content-Type header of application/json will be added if no Content-Type header is
already present on the message.

#### Documentation

The clearest Guzzle documentation is [here](https://guzzle3.readthedocs.io/http-client/client.html#request-options).

## Azure Translator

### Azure Translator PHP Implementations

Azure Translator PHP implementation [code](https://github.com/MicrosoftTranslator/Text-Translation-API-V3-PHP/blob/master/Translate.php).

main [landing page](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)

## Understand These Technologies:

Review:

- [Understanding HTTP](https://developer.mozilla.org/en-US/docs/Web/HTTP)
- [What HTTP is](https://www.w3schools.com/whatis/whatis_http.asp)
- What an [HTTP Messages](https://developer.mozilla.org/en-US/docs/Web/HTTP/Messages) are.
- What [HTTP Authenication](https://developer.mozilla.org/en-US/docs/Web/HTTP/Authentication) is and how it works.
- [Authentication Methods](https://blog.restcase.com/4-most-used-rest-api-authentication-methods/)

- http://www.usingxml.com/Basics/XmlApplications


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
