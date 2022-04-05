<?php
declare(strict_types=1);
use GuzzleHttp\Client;

require 'vendor/autoload.php';

/*
 * This code shows how to authenticate to the DEEPL API using Guzzle.
 * The headers array must contain the key 'Authorization' with a value of the form
 * 
 *  "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",
 * 
 * 
 */

// I.

    /*
     NOTE: Specifying the headers on the constructor doesn't seem to do any good since the `->request(...) call` will fail unless you
     pass $headers to it.
    */
   function test1(Client $client, string $route, array $headers)
   {
        $response = $client->request('get', '/v2/usage', [ 'headers' => $headers ]); 
        
        var_dump($response);
   }
        
  try {

     // This works
     $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ]);

     $headers = [ 'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx", ];
     
     test1($client, '/v2/usage/' ,$headers); 
     
  } catch (Exception $e) {
     
      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
