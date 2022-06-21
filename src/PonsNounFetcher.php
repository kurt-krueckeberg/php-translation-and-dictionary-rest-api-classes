<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\PonsDictionary;

class PonsNounFetcher  {
      
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

   public function __invoke(string $word) : string | null
   {       
      static $query = "//span[@class='genus']/acronym[@class='title']";

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

       $node = $this->body->appendChild($frag);

       $r = $this->xpath->query($query);

       $this->body->removeChild($node);

       if ($r !== false) 
          return $r->textContext;        
       else
          return null;  
    }

}
