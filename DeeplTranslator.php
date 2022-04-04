<?php
declare(strict_types=1);

use GuzzleHttp\Client;

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

  todo: get rid of this class and put its logic into Translator, which will do what this code does, but will do it by using the 
  settings in SimpleXMLElement $provider.

*/
class DeeplTranslator extends Translator {

 
   private static $base_uri = 'https://api-free.deepl.com'; 

   public function __construct() // todo: Change to passin SimpleXMLElement provider that has: authorization and query paraemter names and default values
   {
      $this->client = new Client(array('base_uri' => self::$base_uri));
   }

   /*
     translate() returns an array of translated sentences, in which each element has two properties:

      1. The detected_source_language - which, of course, we required to specified, so there is nothing to 'detect'.
      2. "text" - the translated text in teh target lanauge.

     Client code can iterate over this array like this:

       $translations = $tr->translate($input_sentence, $source_lang, $target_lang);
            
       foreach($translations as $translation) {
 
           do_something($de_sentence, $translation->text);
       } 
   */
   
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

         /* 
          * $obj now holds an array of Deepl 'translations' objects, where 'translations'

	   "translations": [{
	         "detected_source_language":"EN",
	         "text":"Hallo, Welt!"]
          
          */

       var_dump ( $obj->translations); // Return array of translated sentences. 

       return "something";
      
      } catch (RequestException $e) { // We get here if response code from REST server is > 400, like  404 response

         /* Check if a response was received */
         if ($e->hasResponse())
             
            $str = "Response Code is " . $e->getResponse()->getStatusCode();
         else 
             $str = "No respons from server.";

         throw new Exception("Guzzle RequestException. $str"); 
    }

   }
}

  $tr = new DeeplTranslator();

  $translations = $tr->translate("Handeln", "DE", "EN");

  var_dump($translations);

