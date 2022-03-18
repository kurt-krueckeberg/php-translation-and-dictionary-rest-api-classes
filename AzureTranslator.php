<?php
declare(strict_types=1);

use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "GuzzleTranslateAPIWrapper.php";

class AzureTranslator extends GuzzleTranslateAPIWrapper {

    static private $qs_src = "from";
    static private $qs_dest = "to";

    private function com_create_guid() 
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

   public function __construct($service)
   {
         parent::__construct($service);     
   } 

    // todo: break this into the three methods -- prepare_trans_request(), send_trans_request and get_sentences()
    public function prepare_request(string $text, string $source_lang, string $target_lang)
    {

  /* TODO:
    Handle "Content-Length" header:    'Content-length' =>  strlen($content)?

   It is unclear if Content-Length is really required because the Quick Start guide states(https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator?tabs=csharp):

	You can get character counts for both source text and translation output using the translate endpoint. To return sentence length (srcSenLen and transSenLen) you must set the includeSentenceLength parameter to True.
     TODO: 
        -  Add this query sring setting to request, OR 
        -  Do it in the ctro, or
        - Create and return the Request object here. 

   */
         try {

          $query = [ 'from' => $srouce_lang, 'to' => $target_lang];

          $requestBody = [ [ 'Text' => $text, ] ];

          $content = json_encode($requestBody);

	 $response = $this->client->request('POST', $this->base_uri, $query);

         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);
    
         return $obj; // TODO: Return an array of translated "sentences".
      
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
