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

   public function get_dom() : \DOMDocument
   {
       return $this->dom;       
   }
   
   public function add_lookup_results(ResultsIterator $iter) 
   {
       $frag = $this->dom->createDocumentFragment();
       
       $str = $this->build_lookup_str($iter);
       
       $frag->appendXML($str); // todo: Bug
       
       //$this->dom->getElementsByTagName('body')->item(0)->appendChild($frag);
       $list = $this->dom->getElementsByTagName('body');
       $list->item($list->length - 1)->appendChild($frag);;
   }
   
   public function build_lookup_str(ResultsIterator $iter) : string
   {       
       $str = '<div class="defn"><h1 class="hwd">';
       
       foreach($iter as $defns)  {

           $str .= $defns->term ."</h1><h2 class='pos'>[ {$defns->pos} ]</h2>\n";    

           $ul_str = $this->build_defns($defns->definitions);
           
           $str .= $ul_str;
     }
     
     $str .= "</div>";
     return $str;
   }

    // New prospective code  
    private function build_defns(array $definitions) : string
    {       
        $ul = '<ul class="definitions">';

        $lis = '';

        foreach ($definitions as $defn) {

             $lis .= "<li>" . $defn["definition"] . "</li>"; 

             if (isset($defn["expressions"]) && count($defn['expressions']) > 0) {
                 
                $lis .= "<ul class='expressions'>\n"; 

                foreach ($defn['expressions'] as $expression) 

                        $lis .= "<li>". $expression->source  . " - ". $expression->target . "</li>";

                $lis .= "</ul>";
             }  
        } 

        $ul .= $lis . "</ul>";     
 
        return $ul;
    }

    public function __construct()
    { 
       $this->dom = new \DOMDocument("1.0", "UTF8");
       $this->format = true; 
      
       $this->dom->preserveWhiteSpace = false;

       $this->dom->loadHTML(self::$html);
    }
}
