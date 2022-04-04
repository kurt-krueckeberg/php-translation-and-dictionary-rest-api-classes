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
    $headers = [ 'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx", ];
     
    $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ], ['headers' => $headers]);

    echo "hIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII\n";
 
    $response = $client->request('GET', '/v2/usage', ['headers' => $headers]);
     
    var_dump($response);

    return; 

     // Speciying this header on 
     $headers = [ 'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx" ];
      
     $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ], ['headers' => $headers]);

     $response = $client->request('GET', '/v2/usage');
     
     var_dump($response);

     return;     

  try {

     // This works
     $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ]);

     $headers = [ 'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx", ];
      
     $response = $client->request('GET', '/v2/usage', [ 'headers' => $headers ]); 
     
     var_dump($response);
     
     
  } catch (Exception $e) {
     
      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
