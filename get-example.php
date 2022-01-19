<?php

\Guzzle\Http\Client as RestClient;
/* 
 * GET Request example
 * 
 */

   /*
    *  Specify sentence request, adding the corpus. We can either add the encoded query string or pass it as 3rd parameter:
    */  
   $client = new Client($base_uri);

   // $uri has additional fold-like portion of url either wit or without the query string, [
   $response = $client->request('GET', $uri); // $uri here is addition portion of url plus query string 

   // You can also specify the query string parameters using the query request option as an array.
   //
   $response = $client->request('GET', $uri// $uri here is addition portion of url minus query string 
                                 'query' => ['offset' => 0, 'limit' => 10]
                                 ]);
  
   try {

      $response = $request->send();
      
      if (!$response->isSuccessful()) {
   
          return;
      
      }

   } catch (\Exception $e) {
         return;

     }

   $items = $response->json();



$params = [
   'query' => [
      'option_1' => string,
      'option_2' => string
   ]
];
   
   
