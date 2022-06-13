<?php

class test {

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

  private \DOMElement  $body;
  private \DOMDocument $dom;

  public function __construct()
  {
      $this->dom = new \DOMDocument("1.0", "utf-8");
      $this->format = true; 
      
      $this->dom->preserveWhiteSpace = false;
      $this->dom->loadHTML(self::$html);
      $this->body = $this->dom->getElementsByTagName('body')->item(0);
  }

  public function run_test()
  {
     $str = '<section><div class="defn"><h1 class="hwd">';

     $str .= "verändern" . "<span class='pos'>[ Verb ]</span></h1>\n";    

     $str .= $ul_str . "</div>\n";
     
     $ul = '<ul class="definitions">';

     $lis = '';

     $lis .= "<li>" . "to change" . "</li>\n"; 

     $lis .= "</ul>\n";

     $str .= "</section>\n";
 
     $frag = $this->dom->createDocumentFragment();
       
     $frag->appendXML($str); 
       
     $this->body->appendChild($frag);;
  }

  public function get_html() : string
  {
      return $this->dom->saveHTNL();
  }
}   

  $t = new test();
  $t->run_test();

  echo $t->get_html(); 
