<?php
declare(strict_types=1);

use GuzzleHttp\Client;

require 'vendor/autoload.php';

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
 *    $response = $client->request('GET', '/v2/usage', [
 *          'headers' => $headers
 *      ]); 
 *
 *    var_dump($response);
 *
 *  ----------------------------
 *
 *   $headers = [
          'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",
 *   ];
 *   
 *   $client = new Client([ 'base_uri' => 'https://api-free.deepl.com' , 'headers' => $headers]); 
 *   
 *   $response = $client->request('GET', '/v2/usage');
 *   
 *   
 * DEEPL Rquest paramters:
 * =======================
 *   
   $content = [
     'text'        => $source_text,
     'source_lang' => 'DE',
     'target_lang' => 'EN',
   ];
 */ 
class DeeplTranslator extends Translator {

   /*
   private static $base_uri = 'https://api-free.deepl.com/v2/translate'; 

   private const qs_target_lang = 'target_lang';
   private const qs_text = 'text';
   private const qs_auth_key = 'auth_key';
   private const qs_source_lang = 'source_lang';

   private $auth_key; 
   */

   public function __construct(object $simplexml_ele) 
   {
     $auth_key = "blah..blah";

     $headers = [
              //'Authorization' => "DeepL-Auth-Key 7482c761-0429-6c34-766e-fddd88c247f9:fx",
              'Authorization' => "DeepL-Auth-Key $auth_key",
     ];

     $this->client = new Client([ 'base_uri' => 'https://api-free.deepl.com' , 'headers' => $headers]); 

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
   
   // todo: break this into the three methods -- prepare_trans_request(), send_trans_request and get_sentences()
   public function translate(string $text, string $source_lang, string $target_lang) : string
   {
      try {

	 $query =  ['query' => [DeeplTranslator::qs_auth_key => $this->auth_key,
		                DeeplTranslator::qs_text => $text,
				DeeplTranslator::qs_source_lang => $source_lang,
				DeeplTranslator::qs_target_lang => $target_lang]];

	 $response = $this->client->request('GET', self::$base_uri, $query);

         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);

         /* 
          * At this point $obj holds 'translations' object, which is an array of translated sentences, where each
            array element has two properties:

             1. The detected_source_language - which, of course, we required to specified, so there is nothing to 'detect'.
             2. "text" - the translated text in teh target lanauge.

            For example:

	    "translations":[
		    {
			    "detected_source_language": "EN",
			    "text": "Das ist der erste Satz."
		    },
		    {
			    "detected_source_language": "EN",
			    "text": "Das ist der zweite Satz."
		    },
		    {
			    "detected_source_language": "EN",
			    "text": "Dies ist der dritte Satz."
		    }
	         ] 

              */
    
         return $obj->translations; // Return translated Text  
      
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
