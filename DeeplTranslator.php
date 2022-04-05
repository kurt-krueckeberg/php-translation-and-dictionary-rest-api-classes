<?php
declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

require 'vendor/autoload.php';

require_once "Translator.php";

/*
 * Deepl's Free API is a sentence translation service but not a dictionary.
 *
 * Header-based authentication is the preferred method of authentication, and overrides the auth_key parameter.
 * New API functions added in the future will only support the header-based authentication.  
 *
 * DEEPL Authentication:
 *
 * Two examplee code for using Guzzle to authenticate DEEPL:
 *
 *   $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' ]);
 * 
 *    $headers = [                                                                                                                                                                                                                              
 *         'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx", // <-- This is my key. Protect it.
 *    ];
 *     
 *    $response = $client->request('GET', '/v2/translate', [
 *          'headers' => $headers,
            'query' => ['text' =>  urlencode($text),           
			'source_lang' => $source_lang,
			'target_lang' => $target_lang] 
 *      ]); 
 *
 *    var_dump($response);
 *
*/
class DeeplTranslator extends Translator {

   public function __construct(SimpleXMLElement $provider) 
   {
       parent::construct($provider); 
   }

   /* old working code:  
   public function translate(string $text, string $source_lang, string $target_lang) : string
   {
   try {

     $headers = [ 'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx", ];
      

     $response = $this->client->request('GET', "/v2/translate", [ 'headers' => $headers, 'query' => [
		                'text' =>  urlencode($text),           
				'source_lang' => $source_lang,
				'target_lang' => $target_lang] ]);  

      $contents = $response->getBody()->getContents();

      $obj = json_decode($contents);

      return $obj->translations[0]->text); // Return array of translated sentences.  

      
      } catch (RequestException $e) { // We get here if response code from REST server is > 400, like  404 response

     
         if ($e->hasResponse())
             
            $str = "Response Code is " . $e->getResponse()->getStatusCode();
         else 
             $str = "No respons from server.";

         throw new Exception("Guzzle RequestException. $str"); 
    }
    */  

    public function process_response(Response $response) : string
    {
       $contents = $response->getBody()->getContents();

       $obj = json_decode($contents);

       return $obj->translations[0]->text; // Return array of translated sentences. 
     }
}
