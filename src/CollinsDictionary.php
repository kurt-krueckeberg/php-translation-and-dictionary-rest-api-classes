<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class CollinsDictionary implements DictionaryInterface {

   static string  $base_url = "https://api.pons.com/baseurl";
   static string  $method = "GET";
   static string  $route = "v1/dictionary";
   static string  $credential = "X-Secret";

   static string $xpath =  "/providers/provider[@abbrev='p']"; 

   public const SRC_LANG = 'in';
   public const DEST_LANG = 'language';
   public const DICTIONARY = 'l';
   public const INPUT = 'q';

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]
   private array $headers;
   private array $query;

   private Client $client;  

   public function __construct(\SimpleXMLElement $xml)
   {   

       $pons = $xml->xpath(self::$xpath)[0];

       $this->headers[self::$credential] = (string) $pons->settings->secret;

       $this->client = new Client(['base_uri' =>self::$base_url]); 
   } 

   public function lookup(string $text, string $src, string $dest) : string
   {
       $this->query[PonsDictionary::INPUT] = urlencode($text); 

       $this->query[PonsDictionary::SRC_LANG] = strtolower($src);   
       $this->query[PonsDictionary::DEST_LANG] = strtolower($dest); 

       $this->query[PonsDictionary::DICTIONARY] = strtolower($src . $dest);  

       $response = $this->client->request('GET', self::$route, ['query' => $this->query, 'headers' => $this->headers]);       

       $contents = $response->getBody()->getContents();
 
       // todo: urlecode needed?
       /*
       $arr = json_decode($contents, true)[0];
       
       echo count( $arr["hits"] ) . "\n";
       */
       $obj = json_decode($contents)[0];
       
       foreach ($obj->hits as $o) { // hits is an array. foreach hit in the array...
            
           $roms = $o->roms; // access the toms property, whic his an array (stdClass objects)
           
           foreach ($roms as $r) {
               
/*
  [headword] => han·deln      <-- NOTE: The input word was "Handeln" not "handeln", yet translations for the verb handeln were returned?

  [headword_full] (html version) => han<span class="separator">·</span>deln <span class="phonetics">[ˈhandl̩n]</span> <span class="wordclass"><acronym title="verb">VB</acronym></span> <span class="verbclass"><acronym title="intransitive verb">intr</acronym></span>
  [wordclass] => intransitive verb
  [arabs] is an array of objects with the keys:
       [header] => string with the German word, followd by an explanation of some sort. 
       [translations] is an array with the keys:
          [source] with the definition in html or an example sentence
          [target] with the definition or an example sentence.
 
*/ 
               print_r($r);
               
               $debug = 10;
               
               ++$debug;
           }
           

       }
       
       /*
        * 
        * Alternat: object syntax:
        *   $obj->hits
        * 
               
        *  todo: 
        * I. Get the translations
        * 
        * 1. remove html makrup
        * 2. convert htmlentities
        */
       return "nonhing";   
   }
}
