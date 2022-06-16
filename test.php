<?php
declare(strict_types=1);
use LanguageTools\CollinsDictionary;

function test()
{
 static $query = "//span[@class='gramGrp pos']";
 static $qtext = "//span[@class='gramGrp pos']/text()";

static $noun_start =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
    </head>
    <body>
EOS;

 $dom = new \DOMDocument("1.0", 'utf-8');

$div = <<<DIV
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

 $html = $noun_start;
 $html .= $div;
 $html .= "</body></html>";
 
 $dom->loadHTML($html);
     
     $body = $dom->getElementsByTagName('body')->item(0);
 
 $xpath = new \DOMXpath($dom);

  // try the most common query first....
  $nodeList = $xpath->query($qtext);

  var_dump($nodeList->item(0)); 
  echo "\n------------------\n";
}

test();
