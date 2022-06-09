<?php
declare(strict_types=1);
namespace LanguageTools;

/*
  Provides access to config.xml through static method, get_config(string provider)
 */
class Config {

   static \SimpleXMLElement $xml;
   static bool $is_loaded = false;

   static string $xpath =  "/providers/provider[@name='%s']"; 

   static function get_config(string $name) : \SimpleXMLElement
   {
       if (self::$is_loaded == false) {

            self::$xml = simplexml_load_file('config.xml');
            self::$is_loaded = true; 
       }
    
       $query = sprintf(self::$xpath, $name); 
    
       $response = self::$xml->xpath($query);
    
       return $response[0];
   }
}
