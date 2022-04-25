<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RestClient {

   protected Client $client;  

   static public function createRestClient(ClassID $id) : mixed
   {
      $class_name =  $id->class_name();

      $refl_impl = new \ReflectionClass($class_name);            
      
      // Note: The paranthesis around '($id->config_name())' are necessary; otherwise,
      // PHP cannot parse it properly. 
      return $refl_impl->newInstance();
   }

   protected function request(string $method, string $route, array $options) : string
   {
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   }
 
   protected function __construct(string $endpoint)
   {     
       $this->client = new Client(['base_uri' => $endpoint]);
   } 
}
