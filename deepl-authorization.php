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

// NEW test

    // Create a client and provide a base URL
    $client = new Client('https://api-free.deepl.com');
    
    $request = $client->get('/v2/usage');

    $request->setAuth('user', 'pass');

    echo $request->getUrl();
    // >>> https://api.github.com/user
    
    // You must send a request in order for the transfer to occur
    $response = $request->send();
     
     var_dump($response);

     return;     


     // This fails--why?
     $headers = [ 'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx" ];
      
     $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ], ['headers' => $headers]);

     $response = $client->request('GET', '/v2/usage');
     
     var_dump($response);

     return;     

  try {

     // This works
     $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ]);

     $headers = [
        // Example of bearer token setup:   'Authorization' => 'Bearer ' . $token,        
              'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",
     ];
      
       $response = $client->request('GET', '/v2/usage', [ 'headers' => $headers ]); 
     
     var_dump($response);
     
     
  } catch (Exception $e) {
     
      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
