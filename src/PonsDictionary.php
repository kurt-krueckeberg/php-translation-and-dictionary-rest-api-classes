<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class PonsDictionary implements DictionaryInterface {

   private string $route;      
   private string $method;   // GET, POST, etc 
   private string $from;     // key for source language (which is optional)
   private string $to;       // key for destination language (required)

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]

   // private $provider; is defined and set on the constructor's argument list (PHP >=8.0 required).
   
   private Client $client;  

   //?? static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   // PHP 8.0 feature required: automatic member variable assignemnt syntax.
   public function __construct(protected \SimpleXMLElement $provider, string $src_lang, string $dest_lang) 
   {      
       $this->provider = $provider;

       $this->setConfigOptions($provider);

       $this->client = new Client(['base_uri' => (string) $this->provider->settings->baseurl]);
   } 

   private function setConfigOptions(\SimpleXMLElement $provider)
   {
      $headers = array();
                 
      foreach($provider->settings->credentials->header as $header) 
          
         $headers[(string) $header['name']] = (string) $header;

      $this->options['headers'] = $headers;

      $dict = $provider->xpath("requests/request[@type='dictionary']")[0];
      $this->route  = (string) $dict->route;  
      $this->method = (string) $dict->method; 

      $this->setQueryOptions($provider->settings->query);
   }  
   
 /*
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->options['query'][$this->from_key] = $source_lang; 

      $this->options['query'][$this->to_key] = $dest_lang; 
   }
 */
   /*
     Q: Doesn't PONs require a particular dictionary paramter from particular source and destination languages?
        If so, we will need a hashtable to lookup the dictionary based on the inupt (nad maybe output) language.

     A: This will require investigate this--most likely--empricially with test code.
    */
   //--final public function lookup(string $text, string $dest_lang, $source_lang="") //???
   final public function definition(string $text)
   {
       //--$this->setLanguages($dest_lang, $source_lang);

       $this->query['l'] = urlencode($text); // urlencode?

       $response = $this->client->request($this->method, $this->route, $this->options); 

       return $this->extract_translation($response);
   }

   protected function setQueryParm(string $key, string $value)
   {
       $this->options['query'][$key] = $value;
   }

   // Helper method for use by derived classes, to set json input, if needed
   protected function setJson(array $json)
   {
       $this->options['json'] = $json;
   }

   // Calls Guzzle Client post method, mainly intended for AzureTranslator. in addtion to tranlate, it can do
   // diictionary lookups and get example sentences, etc.
   private function post(string $route)
   {
        return $this->client->request('POST', $route, $this->options);
   }

   // Calls Guzzle Client get method, mainly intended for AzureTranslator. in addtion to tranlate, it can do
   // diictionary lookups and get example sentences, etc.
   private function get(string $route)
   {
        return $this->client->request('POST', $route, $this->options);
   }

}
