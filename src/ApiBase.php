<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

// This class is not currently used.

abstract class ApiBase {

   private string $route;      
   private string $method;     // GET, POST, etc 

   // protected $provider; is defined and set on the constructor's argument list (PHP >=8.0 required).
   
   protected Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   /*
    * Returns SimpleXMLElement pointing to correct <provider> element.
    */
   static private function get_provider(string $xml_name, string $abbrev)
   {
      $simp = simplexml_load_file($xml_name);
     
      $query = sprintf(self::$xpath, $abbrev); 
     
      $response = $simp->xpath($query);
     
      return $response[0];
   }

   /* 
      Instantiate the ApiBase-derived class specified in <implementation>...</implementation>
      and pass it the apporpitate \SimpleXmlElement.
    */ 
   static public function createFromXML(string $fxml, string $abbrev) : mixed
   {
      $provider = self::get_provider($fxml, $abbrev); 
      
      $refl = new \ReflectionClass((string) $provider->requests->request[translation]->implementation); 
      
      return $refl->newInstance($provider);
   }

   abstract protected function process_response(string $contents) : mixed; // todo: string | array?

   protected function request(string $method, string $route, array $options)
   {
       $response = $this->client->request($method, $route, $options);

       $conents = $response->getBody()->getContents();

       return $this->process_response($contents);
   } 
   
   /*
    * PHP 8.0 feature: automatic member variable assignemnt syntax.
    */
   public function __construct(protected \SimpleXMLElement $provider) 
   {      
       $this->setConfigOptions($provider);

       $this->client = new Client(['base_uri' => (string) $this->provider->settings->baseurl]);
   } 

   // Overriden by derived classes
   abstract protected function setConfigOptions(\SimpleXMLElement $provider);

   protected function setQueryParm(string $key, string $value)
   {
       $this->options['query'][$key] = $value;
   }

   // Helper method for use by derived classes, to set json input, if needed
   protected function setJson(array $json)
   {
       $this->options['json'] = $json;
   }
}
