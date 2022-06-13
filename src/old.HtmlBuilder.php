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

   private \DOMNode $body;

   private \DOMDocument $dom;   

   public function get_dom() : \DOMDocument
   {
       return $this->dom;       
   }
   
   public function add_lookup_results(string $word, ResultsIterator $iter) 
   {
       $str = $this->build_lookup_str($word, $iter);
       
       $frag = $this->dom->createDocumentFragment();
       
       $frag->appendXML($str); 
       
       $this->body->appendChild($frag);;
   }
   
   public function build_lookup_str(string $word, ResultsIterator $iter) : string
   {       
       $str = "<section>";
       
       foreach($iter as $defns)  {

           $str .= '<div class="defn"><h1 class="hwd">';

           $str .= $defns->term ."<span class='pos'>[ {$defns->pos} ]</span></h1>\n";    

           // todo: Should the <ul> be within a <p>?    
           $ul_str = $this->build_defns($defns->definitions);
           
           $str .= $ul_str . '</div>';
     }
     
     $str .= "</section>";
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

       $this->body = $this->dom->getElementsByTagName('body')->item(0);
    }
}
