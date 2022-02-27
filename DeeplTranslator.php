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

   public function __construct($auth_key) 
   {
      $this->auth_key = $auth_key;

      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; 
   }

   public function translate(string $text, string $source_lang = 'DE', string $target_lang = 'EN')
   {
      //-- $uri = $this->uri . '/' . urlencode($text);

      // TODO: lookup DeepL target_lang string in static class hashtable using \Ds\Hastable?
      // Language list: https://www.deepl.com/docs-api/translating-text/request/  
      // $target_lang = "todo";

      // TODO: lookup DeepL source_lang string in static class hashtable using \Ds\Hastable?
      // $source_lang = "todo";

      try {
	 // TODO:  I'm not sure that auth_key is a query parameter?
         $query =  array('query' => array(DeeplTranslator::qs_auth_key => $this->auth_key,
		                                  DeeplTranslator::qs_text => $text,
						  DeeplTranslator::qs_source_lang => $source_lang,
						  DeeplTranslator::qs_target_lang => $target_lang
	                                            ));
	 print_r($query);

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
