<?php
declare(strict_types=);
namespace LanguageTools;
use LanguageTools\SystranDictResult;

class HtmlBuilder {

   private readonly static string $html = <<<html
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    </body>
</html>
html;

    private readonly static string $defn = <<<defn
<div class="defn">
  <h1 class="hwd"></h1>
  <ul>
  </ul>
</div>
defn;

   private \DOMDocument $dom;
   

   private function build_lookup_node(ResultsIterator $iter) 
   {
       $dom = new DOMDocument("1.0", "UTF8");

       $dom->preserveWhiteSpace = false;

       $dom->loadHTML(self::$defn);

       foreach($iter as $defns)  {

           $term = $dom->createTextNode( $defns->term );    

           $h1 = $dom->getElementByTagName('h1'); 
           $h1->appendChild($tern);
 
           $pos = $dom->createTextNode( "<span class='pos'>"  . $defns->pos . "</span>" );    
           // todo: $pos -- append where?

           $ul = $this->build_defns_node($defns->definitions);

           $dom->appendChild($ul);
     }

    /* 
      Get <ul> of defintions and any expressions
     */
    private function build_defns_node(array $definitions) : \DOMDocument 
    {
       $dom = new DOMDocument("1.0", "UTF8");

       $dom->preserveWhiteSpace = false;

       $dom->loadHTML("<ul>\n</ul>");

       $frag = $dom->createDocumentFragment();
  
       $lis = '';

        foreach ($definitions as $defn) {

             $lis .= "<li>" . $defn["definition"] . "</li>\n"; 

             if (isset($defn["expressions"])) {
                 
                $lis .=o "<ul>\n"; 

                foreach ($defn['expressions'] as $expression) 

                        $lis .= "<li>". $expression->source  . " - ". $expression->target . "</li>\n";

                $lis .= "</ul>\n";
             }  
        } 
       
       // Append the XML
       $frag->appendXML($lis);
 
       /*
       $ul = $dom->getElementsByTagName('ul')->item(0);
         
       // Append the fragment
       $ul->appendChild($frag);
       */
       $dom->appendChild($frag);
 
       return $dom;
    }

    public function __construct()
    { 
       $this->dom = new \DOMDocument("1.0", "UTF8");
       $this->format = true; 
    }


}
