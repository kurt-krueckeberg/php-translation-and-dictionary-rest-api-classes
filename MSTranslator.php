<?php
use GuzzleHttp\Client;

require 'vendor/autoload.php';

/*
 * Deepl's Free API is a sentence translation service but not a dictionary.
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
class MSTranslator implements Translator {

    // ++ private string|object $caption; // Example of PHP8.0 union type declaration.

    private static string $subscriptionKey = "YOUR_SUBSCRIPTION_KEY" ;
    private static string $endpoint = "https://api.cognitive.microsofttranslator.com/";

    // Add your location, also known as region. The default is global.
    // This is required if using a Cognitive Services resource.
    private static string $location = "YOUR_RESOURCE_LOCATION";
    
    public function __construct(string $route)
    {
       $this->route = $route = "/translate?api-version=3.0&from=en&to=de&to=it";
 
      $this->client = new Client(array('base_uri' => self::$base_uri));

      $this->header = "accept: application/json"; 

      // Input and output languages are defined as parameters.
        
    } 

    public function translate(string $text, string $source_lang, string $target_lang) : string
    {
      try {

            /*
             TODO: these are MS Requirements"

            Encoding UTF-8 +  "application/json"

            // Headers
            request.Headers.Add("Ocp-Apim-Subscription-Key", $this->subscriptionKey);

            request.Headers.Add("Ocp-Apim-Subscription-Region", $this->location);
            */

	 $query =  ['query' => [ => $text,
				=> $source_lang,
				=> $target_lang]];

         $request_url = $this->endpoint . $this->route;

	 $response = $this->client->request('POST', $request_url, $query);

         $contents = $response->getBody()->getContents();

         $obj = json_decode($contents);
         /* 

            NOTE: This ONLY pertains to DEEPL's return object:  

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
