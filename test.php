<?php
declare(strict_types=1);
use LanguageTools\CollinsDictionary;

function test(string $div)
{ 
static $q1 = "//span[@class='gramGrp pos']";
static $q2 = "//span[@class='gramGrp']/span[@class='pos']";

static $noun_start =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
    </head>
    <body>
EOS;


    $dom = new \DOMDocument("1.0", 'utf-8');
   
    $html = $noun_start;
   
    $html .= $div;
   
    $html .= "</body></html>";
    
    $dom->loadHTML($html);
        
    $body = $dom->getElementsByTagName('body')->item(0);
    
    $xpath = new \DOMXpath($dom);
   
    // try the most common query first....
    $nodeList = $xpath->query($q1);
     
    $str = '';
   
    if ($nodeList->count() == 1) { // ...if it fails, we try the other query
   
        $node = $nodeList->item(0); // \DOMText
   
        $str = $node->textContent;
   
    } else {
   
       $nodeList = $xpath->query($q2);
   
       foreach($nodeList as $node) {
   
          $str .= $node->textContent . ' ';
       } 
    }
   
    echo $str;
}

$div1 = <<<DIV
<div class="entry_container">
  <div class="entry lang_de" id="befund_1">
    <h1 class="hwd">
      <span class="inline">Befund</span>
    </h1>
    <div class="hom" id="befund_1.1">
      <span>&nbsp;</span> <span class="gramGrp pos">masculine noun</span>
      <div class="sense">
        <span class="cit lang_en-gb quote">results <em class="hi">pl</em></span><span class="cit" id="befund_1.2"><span>; &nbsp;</span> <span class="quote">der Befund war positiv/negativ</span> <span class="lbl"><span>(</span>medicine<span>)</span></span> <span class="cit lang_en-gb quote">the results were positive/negative</span></span><span class="cit" id="befund_1.3"><span>; &nbsp;</span> <span class="quote">ohne Befund</span> <span class="lbl"><span>(</span>medicine<span>)</span></span> <span class="cit lang_en-gb quote">(results) negative</span></span>
      </div><!-- End of DIV sense-->
    </div><!-- End of DIV hom-->
  </div><!-- End of DIV entry lang_de-->
</div>
DIV;

$div2 = <<<DIV
<div class="entry_container">
  <div class="entry lang_de" id="facharbeiter_1">
    <h1 class="hwd">
      <span class="inline">Facharbeiter</span>
    </h1><span class="inline orth"><span class="bluebold">,</span> in</span>
    <div class="hom" id="facharbeiter_1.1">
      <span>&nbsp;</span> <span class="gramGrp"><span class="pos">masculine noun</span><span>,</span> <span class="pos">feminine noun</span></span>
      <div class="sense">
        <span class="cit lang_en-gb quote">skilled worker</span>
      </div><!-- End of DIV sense-->
    </div><!-- End of DIV hom-->
  </div><!-- End of DIV entry lang_de-->
</div>
DIV;


test($div1);
echo "\n";
test($div2);
