<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

// This class is not currently used.

class RestApi {

   protected Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   /* 
      Instantiate the RestApi-derived class specified in <implementation>...</implementation>
      and pass it the apporpitate \SimpleXmlElement.
    */ 
   static public function createFromXML(\SimpleXMLElement $xml, string $abbrev) : mixed
   {
      $query = sprintf(self::$xpath, $abbrev);

      $provider = $xml->xpath($query)[0];

      $refl = new \ReflectionClass((string) $provider->settings->implementation); 
      
      return $refl->newInstance($provider);
   }

   protected function request(string $method, string $route, array $options) : string
   {
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   } 
   
   /*
    * PHP 8.0 feature: automatic member variable assignemnt syntax.
    */
   public function __construct(\SimpleXMLElement $provider) 
   {      
       $this->client = new Client(['base_uri' => (string) $provider->settings->baseurl]);
   } 
}
