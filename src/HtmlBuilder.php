<?php
declare(strict_types=);
namespace LanguageTools;
use LanguageTools\SystranDictResult;

class HtmlBuilder {

   private readonly static string $html = <<<html
<?xml version="1.0" standalone="yes"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd"
<meta charset="UTF-8"> >
<title>Deutsche Wortschatz</title>
<html lang="de">
<body>
<header>
  <h1>German Vocabulary</h1>
</header>
</body>
</html>
html;

    private readonly static string $defn_html = <<<defn
<div class="defn">
  <h1 class="hwd"></h1>
  <ul>
  </ul>
</div>
defn;

    private \DOMDocument $dom;
     
    private function create_defn(ResultsIter $iter) : \DOMDocument // or DOMNoide
    {
       $dom = new DOMDocument("1.0", "UTF8");

       $dom->loadHTML($defn);

       $xpath = new DOMXPath($dom);

      //  XPath queries along with the DOMXPath::query method can be used to return the list of elements that are searched for by the user.

       $tags = $xpath->query('//div[@class="defn"]/h1[@class="hwd"]');

       /*
       $doc->getElementsByTagName("h1")->item(0)->appendChild($doc->createTextNode($iter->term)); 

       foreach ($tags as $tag) {

          var_dump(trim($tag->nodeValue));

       }
       */

       foreach($iter as $defns)  {

           echo "<span class='pos'>"  . $defns->pos . "</span>";    // addNode
 
           echo "<ul>\n"; // addNode

           /*

              todo:
              1. Add <li>Node and associated text
              2. If expressions add nested <unorderd list of expressions:
            */

           foreach ($defns->definitions as $defn) {

                echo "<li>" . $defn["definition"] . "</li>\n"; 

                if (isset($defn["expressions"])) {
                    
                   echo "<ul>\n"; 

                   foreach ($defn['expressions'] as $expression) 

                           echo "<li>". $expression->source  . " - ". $expression->target . "</li>\n";

                   echo "</ul>\n";
                }  
           } 
       } 
       /*
         todo: Return this dom node, so it can be insert into overall documentI
        */
    }

    public function __construct()
    { 
       $this->dom = new \DOMDocument("1.0", "UTF8");
       $this->format = true; 
    }


}
