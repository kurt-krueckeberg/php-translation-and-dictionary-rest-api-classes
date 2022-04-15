<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class PonsDictionary implements DictionaryInterface {

   static string  $base_url = "https://api.pons.com/baseurl";
   static string  $method = "GET";
   static string  $route = "v1/dictionary";
   static string  $credential = "X-Secret";

   public const SRC_LANG = 'in';
   public const DEST_LANG = 'language';
   public const DICTIONARY = 'l';
   public const INPUT = 'q';

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]
   private array $headers;
   private array $query;

   private Client $client;  

   public function __construct(string $key)
   {   
       $this->headers[self::$credential] = $key;

       $this->client = new Client(['base_uri' =>self::$base_url]); 
   } 

   public function lookup(string $str, string $src, string $dest) : string
   {
       $this->query[PonsDictionary::INPUT] = urlencode($text); 

       $this->query[PonsDictionary::SRC_LANG] = strtolower($src);   
       $this->query[PonsDictionary::DEST_LANG] = strtolower($dest); 

       $this->query[PonsDictionary::DICTIONARY] = strtolower($src . $dest);  

       $response = $this->client->request('GET', $this->route, ['query' => $this->query, 'headers' => $this->headers]); 

       // todo: process this ... urldecode ??
   }
}
