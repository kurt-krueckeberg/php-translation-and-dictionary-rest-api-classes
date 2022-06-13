<?php

class test {

static private string $html = <<<html_eos
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    </body>
</html>
html_eos;


  private \DOMElement  $body;
  private \DOMDocument $dom;

  public function __construct()
  {
      $this->dom = new \DOMDocument("1.0", "utf-8");
      $this->format = true; 
      
      $this->dom->preserveWhiteSpace = false;
      
      $this->dom->validateOnParse = true;
      
      $this->dom->loadHTML(self::$html);
      
      $this->dom->validate();
      
      $this->body = $this->dom->getElementsByTagName('body')->item(0);
  }

  public function run_test()
  {
     $str = '<section><div class="defn"><h1 class="hwd">';

     $str .= "verändern" . "<span class='pos'>[ Verb ]</span></h1>\n";    

     $ul = '<ul class="definitions">';

     $lis = '';

     $lis .= "<li>" . "to change" . "</li>\n"; 

     $lis .= "</ul>\n";

     $str .= "</div></section>\n";
 
     $frag = $this->dom->createDocumentFragment();
       
     $frag->appendXML($str); 
       
     $this->body->appendChild($frag);
  }

  public function get_html() : string
  {
      return $this->dom->saveHTML();
  }
}   

  $t = new test();
  $t->run_test();

  echo $t->get_html(); 
