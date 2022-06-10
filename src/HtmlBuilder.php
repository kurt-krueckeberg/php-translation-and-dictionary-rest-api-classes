<?php
declare(strict_types=);
namespace LanguageTools;

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
     
    public function __construct()
    { 
       $this->dom = new \DOMDocument("1.0", "UTF8");
       $this->format = true; 
    }
}
