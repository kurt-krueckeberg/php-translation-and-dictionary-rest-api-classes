<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

// This class is not currently used.

class RestClient {

   protected Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   /* 
      Instantiate the RestClient-derived class specified in <implementation>...</implementation>
      and pass it the apporpitate \SimpleXmlElement.
    */ 
   static public function createRestClient(\SimpleXMLElement $xml, ClassID $id) : mixed
   {
      $query = sprintf(self::$xpath, (string) $id);

      $provider = $xml->xpath($query)[0];

      $refl = new \ReflectionClass((string) $provider->settings->implementation); 
     
      // BackedEnum::from($abbrev)  -- does string to ClassID conversion
      return $refl->newInstance($provider, $abbrev);
   }

   protected function request(string $method, string $route, array $options) : string
   {
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   }
 
   /*
    * PHP 8.0 feature: automatic member variable assignemnt syntax.
    */
   protected function __construct(\SimpleXMLElement $provider, ClassID $id) 
   {     
       /* todo: Is this stil needed?
 
       if ( (string) $provider['abbrev']!== $abbrev) 
             throw new \Exception("Wrong provider passed");
       */
       
       $this->client = new Client(['base_uri' => (string) $provider->settings->baseurl]);
   } 
}
