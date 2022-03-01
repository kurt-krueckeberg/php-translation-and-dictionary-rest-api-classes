<?php
use GuzzleHttp\Client;

require 'vendor/autoload.php';

/*
 * Note: Deepl's Free API doesn't do dictionary-like translations of single words only sentences.
 *
 * DEEPL Rquest paramters:
 *
$content = [
    'auth_key'    => $your_api_key,
    'text'        => $source_text,
    'source_lang' => 'EN',
    'target_lang' => 'JA',
];
 */ 
class DeeplTranslator {
    
   private static $base_uri = 'https://api-free.deepl.com/v2/translate'; 

   private const qs_target_lang = 'target_lang';
   private const qs_text = 'text';
   private const qs_auth_key = 'auth_key';
   private const qs_source_lang = 'source_lang';

   private $auth_key; 

   public function __construct($auth_key) 
   {
      $this->auth_key = $auth_key;

      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; 
   }

   public function translate(string $text, string $source_lang, string $target_lang)
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
          * $obj now holds an array of Deepl 'translations' objects, where 'translations'

	   "translations": [{
	         "detected_source_language":"EN",
	         "text":"Hallo, Welt!"]
          *
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
