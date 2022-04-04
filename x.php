<?php
declare(strict_types=1);
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request; 


require 'vendor/autoload.php';

/*
 * This code shows how to authenticate to the DEEPL API using Guzzle.
 * The headers array must contain the key 'Authorization' with a value of the form
 * 
 *  "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",
 * 
 * 
 */

    $headers = [ 'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",  'Content-Type' => 'application/json'];

    // Create a client and provide a base URL

    $client = new Client(['base_uri' => 'https://api-free.deepl.com']);
 
    $response = $client->request('GET', '/v2/usage', [ 'headers' => $headers ]); 
     
    var_dump($response);

    echo "\n========================================\n"; 

    $request = new Request('GET', '/v2/usage', [ 'headers' => $headers ]);  // <-- This fails.

    $response = $client->send($request);
     
    var_dump($response);

    return;     
