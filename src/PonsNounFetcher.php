<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\PonsDictionary;

class PonsNounFetcher implements NounFetchInterface  {
      
      private \DOMDocument $dom;
      private PonsDictionary $dict;
     
      private \DOMNode $body;

      private \DOMXpath $xpath;

   public function __construct(PonsDictionary $dict)
   {   
static $html =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
  <head>
  </head>
  <body>
  </body>
</html>        
EOS;

      $this->dict = $dict;

      $this->dom = new \DOMDocument("1.0", 'utf-8');
      
      $this->dom->loadHTML($html);

      $this->body = $this->dom->getElementsByTagName('body')->item(0);

      $this->xpath = new \DOMXpath($this->dom);
   } 

   public function get_plural(string $word) : string | null
   {
        return null;
   }

   public function get_noun(string $word) : string | null
   {       
      // sample:  <span class="genus"><acronym title="feminine">
      static $query = "//span[@class='genus']/acronym/@title";

      $iter = $this->dict->search($word, "de", "en");

      foreach ($iter as $r) {
            
         //  $x = strip_Tags($rom->headword); // and we must remove the spearator
         // $x = trim($x, "" )
         
         //if ($x == $word && isset($rom->wordclass)) {
         if (isset($r->pos) && $r->pos == "noun") {

                 $hwf = "<p>" . $r->headword_full . "</p>";
                 break;
         } 
       }

       $frag = $this->dom->createDocumentFragment(); 

       $frag->appendXML("<p>$hwf</p>");

       $child = $this->body->appendChild($frag);

       $list = $this->xpath->query($query);
              
       $result = ($list !== false && $list->count() == 1) ? $list->item(0)->textContent : null;        
       
       $this->body->removeChild($child);

      return $result;  
    }
}
