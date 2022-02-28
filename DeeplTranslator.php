<?php
use GuzzleHttp\Client;

require 'vendor/autoload.php';

/*
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
          
         if ($response->getStatusCode() !== 200) { // 200 == success
              
             throw new Exception("Error..."); // TODO : Decide on exception type and message. 
         }
 
         $contennts = $response->getBody()->getContents();
         
         return json_decode($contents); // todo: describe this objects' properties
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;

      }  catch (\Exception $e) { 

         throw $e; // re-throw
      }
   }
}
