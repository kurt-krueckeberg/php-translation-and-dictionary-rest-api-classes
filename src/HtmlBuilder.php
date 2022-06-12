<?php
declare(strict_types=1);

namespace LanguageTools;
use LanguageTools\SystranDictResult;

class HtmlBuilder {

static private string $html = <<<html
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

    static private string $defn = <<<defn
<div class="defn">
  <h1 class="hwd"></h1>
</div>
defn;

   private \DOMDocument $dom;   

/*
   public function build_lookup_node(\DOMDocument $dom, ResultsIterator $iter) : \DOMDocument
   {
       $freg = $dom->createDocumentFragment();

       $dom = new \DOMDocument("1.0", "UTF8");

       $dom->preserveWhiteSpace = false;

       $dom->loadHTML(self::$defn);

       foreach($iter as $defns)  {

           $term = $dom->createTextNode( $defns->term );    

           $h1 = $dom->getElementsByTagName('h1')->item(0); 
           
           $h1->appendChild($term);
 
           $pos = $dom->createTextNode( "<span class='pos'>"  . $defns->pos . "</span>" );    
           // todo: $pos -- append where?

           $ul = $this->build_defns_fragment($dom, $defns->definitions);

           $dom->getElementsByTagName('div')->item(0)->appendChild($ul);
     }
     return $dom;
   }
*/
   public function add_lookup_results(ResultsIterator $iter) : \DOMDocument
   {
       $frag = $this->dom->createDocumentFragment();

       $frag = $this->build_lookup_frag($frag, $iter);
       
       $this->dom->appendChild($frag);
   }
   
   public function build_lookup_frag(\DOMDocumentFragment $frag, ResultsIterator $iter) : \DOMDocumentFragment
   {       
       $frag->appendXML('<div class="defn">\n<h1 class="hwd">');

       foreach($iter as $defns)  {

           $frag->appendXML($defns->term);
 
           $pos = "<span class='pos'>"  . $defns->pos . "</span>" );    

           $ul_defns = $this->build_defns_fragment($defns->definitions);

           $frag->getElementsByTagName('div')->item(0)->appendChild($ul_defns);
     }
     "</div>";
     return $frag;
   }

    // New prospective code  
    private function build_defns_fragment(array $definitions) : \DOMDocumentFragment 
    {
       $frag = $this->dom->createDocumentFragment();

       $ul = '<ul class="definitions">';

       $lis = '';

        foreach ($definitions as $defn) {

             $lis .= "<li>" . $defn["definition"] . "</li>\n"; 

             if (isset($defn["expressions"]) && count($defn['expressions']) > 0) {
                 
                $lis .= "<ul class='expressions'>\n"; 

                foreach ($defn['expressions'] as $expression) 

                        $lis .= "<li>". $expression->source  . " - ". $expression->target . "</li>\n";

                $lis .= "</ul>\n";
             }  
        } 

       $frag->appendXML($ul . $lis);       
 
       return $frag;
    }

    public function __construct()
    { 
       $this->dom = new \DOMDocument("1.0", "UTF8");
       $this->format = true; 
       $dom = new \DOMDocument("1.0", "UTF8");

       $dom->preserveWhiteSpace = false;

       $dom->loadHTML(self::$defn);


    }


}
