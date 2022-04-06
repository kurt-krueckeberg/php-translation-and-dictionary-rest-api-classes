<?php
declare(strict_types=1);
namespace Translators;

use GuzzleHttp\Psr7\Response;

require 'vendor/autoload.php';

// See documentation in Deepl-doc.md 
class DeeplTranslator extends Translator {

   public function __construct(\SimpleXMLElement $provider) 
   {
       parent::__construct($provider); 
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

    protected function prepare_input(string $text) : string
    {
        /*
        $query_array['text'] = urlencode($text);
        return $query_array;
         */
        return  urlencode($text);
    }

    public function process_response(Response $response) : string
    {
       $contents = $response->getBody()->getContents();

       $obj = json_decode($contents);

       return $obj->translations[0]->text; // Return array of translated sentences. 
     }
}
