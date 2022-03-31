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

     $headers = [
        // Example of bearer token setup:   'Authorization' => 'Bearer ' . $token,        
              'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",
     ];
      
     $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ], ['headers' => $headers]);

     $response = $client->request('GET', '/v2/usage', [
             'headers' => $headers
         ]); 
     
     var_dump($response);

return;     

$client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ]);
 
  try {


     $headers = [
        // Example of bearer token setup:   'Authorization' => 'Bearer ' . $token,        
              'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",
     ];
      
       $response = $client->request('GET', '/v2/usage', [
             'headers' => $headers
         ]); 
     
     var_dump($response);
     
     
  } catch (Exception $e) {
     
      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
