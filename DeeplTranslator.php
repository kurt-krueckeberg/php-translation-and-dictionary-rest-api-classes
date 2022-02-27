<?php
use GuzzleHttp\Client;

require 'vendor/autoload.php';

/*
 *  TODO: How and where to specify for Guzzle:
 *
 *  1. authorization key. See https://docs.guzzlephp.org/en/stable/request-options.html?highlight=authorization%20key
 *  2. target language 
 *  3. text to translate
 *
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

/*
 * Deepl Free API query string parameters:
 *
 * auth_key=7482c761-0429-6c34-766e-fddd88c247f9:fx \
 *	-d "text=Hello, world!"  \
 *	-d "target_lang=EN"
 *
 */ 
   private const qs_target_lang = 'target_lang';
   private const qs_text = 'text';
   private const qs_auth_key = 'auth_key';
   private const qs_source_lang = 'source_lang';

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.
   private $auth_key; 

   private function __construct($auth_key) 
   {
      $this->auth_key = $auth_key;

      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; 
   }

   static function create() 
   {
       return new DeeplTranslator($api_key);
   }

   public function translate(string $text, string $source_lang = 'DE', string $target_lang = 'EN')
   {
      try {

	 $query =  ['query' => [DeeplTranslator::qs_auth_key => $this->auth_key,
		                DeeplTranslator::qs_text => $text,
				DeeplTranslator::qs_source_lang => $source_lang,
				DeeplTranslator::qs_target_lang => $target_lang]];

	 $response = $this->client->request('GET', self::$base_uri, $query);

      
         $result = $response->getBody()->getContents();
         
         return $result;
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;

      }  catch (\Exception $e) { 

         throw $e; // re-throw
      }
   }
}
