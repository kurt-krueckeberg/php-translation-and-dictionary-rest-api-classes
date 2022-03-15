<?php
declare(strict_types=1);

use GuzzleHttp\Client;

require 'vendor/autoload.php';

include "GuzzleTranslateAPIWrapper.php";

class MSTranslator extends GuzzleTranslateAPIWrapper {

    private static string $subscriptionKey = "YOUR_SUBSCRIPTION_KEY" ;

    // Add your location, also known as region. The default is global.
    // This is required if using a Cognitive Services resource.
    private static string $location = "YOUR_RESOURCE_LOCATION";    // ?????????????

    private static $base_uri = "https://api.cognitive.microsofttranslator.com/translate?api-version=3.0";

    // Query parameters:
    private static $qs_api_version = "api-version"; // Required query parameter. USE: "3.0"
    private static $qs_target_lang = 'to';         // Required query parameter
    private static $qs_source_lang = 'from';
    private static $qs_text_type   = 'plain';  // 'plain' or 'html'

   
    private function build_header($bearerToken) // Make this a lambda
    {
          return  [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $bearerToken,
            ];
    }  
    https://docs.guzzlephp.org/en/stable/request-options.html#auth
    public function __construct(string $key, string $location)
    {
        
      $this->client = new Client(array('base_uri' => self::$base_uri), 'headers' => $this->build_header($bearerToken) );

      $this->header = "accept: application/json"; 
    } 

    // todo: break this into the three methods -- prepare_trans_request(), send_trans_request and get_sentences()
    public function prepare_trans_request(string $text, string $source_lang, string $target_lang) : string
    {
      try {

          $requestBody = [ [ 'Text' => $text, ] ];

          $content = json_encode($requestBody);

         /*
          * TODO: See header documentation for required header settings
          */

	 $query =  ['query' => [self::$qs_api_version => '3.0', 
                                self::$qs_source_lang => $srouce_lang,  // TODO: <-- Need to use generic values that work acorss all translators, doing a hasttable lookup if necessary.
                                self::$qs_target_lang => $target_lang,  // TODO: <-- Need to use generic values that work acorss all translators, doing a hasttable lookup if necessary.
                                self::$qs_text_type   => 'plain'
                               ] ]; 

	 $response = $this->client->request('POST', $this->base_uri, $query);

         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);
    
         return $obj->???????; // TODO: Change per Microsoft docs
      
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
