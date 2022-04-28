<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RestClient {

   protected Client $client;  

   // todo: Add this array based on https://www.loc.gov/standards/iso639-2/php/code_list.php
   private static array $isocodes = array();

   protected static function is_code_valid($code) // IS $code a valid ISO 639-1 Code?
   {
      return  isset(self::$isocode[$code]) ? true : false;  
   }

   static public function createRestClient(ClassID $id) : mixed
   {
      $class_name =  $id->class_name();

      $refl_impl = new \ReflectionClass($class_name);            
      
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
