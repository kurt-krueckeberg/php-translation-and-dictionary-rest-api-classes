<?php
declare(strict_types=);
namespace LanguageTools;
use LanguageTools\SystranDictResult;

class HtmlBuilder {

   private readonly static string $html = <<<EOS
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
EOS;

    private readonly static string $defn_html = <<<EOS
<div class="defn">
  <h1 class="hwd"></h1>
  <ul>
  </ul>
</div>
EOS;

    private \DOMDocument $dom;
     
    private function insert_defn(ResultsIter $iter)
    {
       $doc = new \DOMDocument("1.0", "UTF8");

       $doc->loadHTML(HtmlBuilder::$defn_html);

       $doc->getElementsByTagName("h1")->item(0)->appendChild($doc->createTextNode($iter->term)); 

       foreach($iter as $defns)  {

           echo "<span class='pos'>"  . $defns->pos . "</span>";    // addNode
 
           echo "<ul>\n"; // addNode

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
    }

    public function __construct()
    { 
       $this->dom = new \DOMDocument("1.0", "UTF8");
       $this->format = true; 
    }


}
