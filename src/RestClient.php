<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RestClient {

   protected Client $client;  

   private $headers = array();

   protected static function is_code_valid($code) // <-- Not yet implemented
   {
      return  isset(self::$isocode[$code]) ? true : false;  
   }

   static public function createClient(ClassID $id) : mixed
   {
      $class_name =  $id->class_name();

      $refl_impl = new \ReflectionClass($class_name);            
      
      return $refl_impl->newInstance($id);
   }

   protected function request(string $method, string $route, array $options = array()) : string
   {
       $options['headers'] = $this->headers;
 
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   }
 
   protected function __construct(ClassID $id)
   {     
       $simplexml = Config::get_config($id->get_provider());

       $this->client = new Client( ['base_uri' => (string) $simplexml->endpoint] );

       foreach($simplexml->headers->header as $header) {

             $key = (string) $header['key'];

             $this->headers[$key] =  (string) $header;              
       }
   }
}
