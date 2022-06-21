<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\CollinsGermanDictionary;

class CollinsNounFetcher implements NounFetchInterface  {
      
      private \DOMDocument $dom;
      private CollinsGermanDictionary $dict;
     
      private \DOMNode $body;

      private \DOMXpath $xpath;

   public function __construct(CollinsGermanDictionary$dict)
   {   
static $html =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
  <head>
  </head>
EOS;

     /*
        todo: Move the CollinsGermanDictionary::get_noun_info()
        code here and implement the NounFetchInterace method with it.  
      */
      $this->dict = $dict;

      $this->dom = new \DOMDocument("1.0", 'utf-8');
    }      
    

   public function get_plural(string $word) : string | null
   {
        return null;
   }

   public function get_gender(string $word) : string | null
   {       
   }
}
