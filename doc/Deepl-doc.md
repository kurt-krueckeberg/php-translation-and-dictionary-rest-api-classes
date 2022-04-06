Deepl Translation REST API
==========================

Translation Endpoint and Route
------------------------------

The endpoint or base URL for a Translator 3.0 request is:

  ------------------------------- ---------------
  Endpoint                        URL "route"
  https://api-free.deepl.com      /v2/translate
  ------------------------------- ---------------

Authentication
--------------

Currently all requests support the following two ways to provide your authentication keys:

-   Header-based authentication by setting the *Authorization* header (*DeepL-Auth-Key \[yourAuthKey\]*)

-   Setting the *auth\_key* as a request parameter

### Header-based Authentication

Header-based authentication is the preferred method of authentication,
and overrides the *auth\_key* parameter. New API functions added in the
future will only support the header-based authentication.

Example HTTP Request

```bash
GET /v2/usage HTTP/1.0
Host: api-free.deepl.com
User-Agent: YourApp
Accept: */*
Authorization: DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx
```

Example Curl Request

```bash
curl -H \"Authorization: DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx\" https://api-free.deepl.com/v2/usage
```

Example using PHP and Guzzle library.

/*
 * Header-based authentication is the preferred method of authentication, and overrides the auth_key parameter.
 * New API functions added in the future will only support the header-based authentication.  
*/

```php
<?php
declare(strict_types=1);
use GuzzleHttpClient;

require 'vendor/autoload.php';
    
   try {
       
      $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ]);                                                                                                                                                                          
                                                                                                                                                                                                                                                 
      $headers = [                                                                                                                                                                                                                              
           'Authorization' => "DeepL-Auth-Key Your-Key-Here:fx", 
      ];
       
      $response = $client->request('GET', '/v2/translate', [
            'headers' => $headers,
            'query' => ['text' =>  urlencode($text),           
    		    'source_lang' => $source_lang,
    		    'target_lang' => $target_lang] 
        ]); 
      
   } catch (Exception $e) {
       
       echo "Exception: message = " . $e->getMessage() . "n";
       
   }
```
