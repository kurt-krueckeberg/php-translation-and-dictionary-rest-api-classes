<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

$client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ]);
 
  try {

/*
   curl -H "Authorization: DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx" https://api-free.deepl.com/v2/usage

*/
// $headers = ['X-Foo' => 'Bar'];

/*
All these failed:

  $response = $client->request('GET', '/v2/usage', [ 'Authorization' => 'DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx' ]);

  $response = $client->request('GET', '/v2/usage', ['auth' => ['DeepL-Auth-Key',  '7482c761-0429-6c34-766e-fddd88c247f9:fx' ]]);
 */

  $response = $client->request('GET', '/v2/usage', ['auth' => ['DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx', ]]);

var_dump($response);


  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
