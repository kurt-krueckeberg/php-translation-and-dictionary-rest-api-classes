<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\PonsDictionary;

class PonsNounFetcher  {
      
      private \DOMDocument $dom;
      private PonsDiciontary $dict;
     
      private \DOMNode $body;

      private \DOMXpath $xpath;

   public function __construct(PonsDictioary $dict)
   {   
static $noun_start =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
    </head>
    <body>
EOS;

      $this->dict = $dict;

      $html = $noun_start;

      $html .= '</body.</html>';

      $this->dom = new \DOMDocument("1.0", 'utf-8');
     
      $this->dom->loadHTML($html);

      $this->body = $this->dom->getElemtnsByTagName('body')->item(0);

      $this->xpath = new \DOMXpath($this->dom);
   } 

   public function __invoke(string $word) : string | null
   {       
      static $query = '//span[@class="???"/acronym[@class="title"]';

      $iter = $this->dict($word, "de", "en");

       foreach ($iter as $r) {
            
         //  $x = strip_Tags($rom->headword); // and we must remove the spearator
         // $x = trim($x, "" )
         
         //if ($x == $word && isset($rom->wordclass)) {
         if (isset($r->wordclass) && $r->wordclass == "noun") {

                 $hwf = "<p>" . $rom->headword_full . "</p>";
                 break;
         } 
       }

       $frag = $this->dom->createDocumentFragment(); 

       $frag->appendXML("<p>$hwf</p>");

       $node = $hits->body->appendChild($frag);

       $r = $this->xpath->query($query);

       $hits->body->removeChild($node);

       if ($r !== false) 
          return $r->textContext;        
       else
          return null;  
    }

}
