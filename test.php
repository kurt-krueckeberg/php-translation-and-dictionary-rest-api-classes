<?php
declare(strict_types=1);

 $p1 = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

 $p2 = "']/.."; 

 function test1(string $query)
 {
    $xml = simplexml_load_file("config.xml");

    $s = $xml->xpath($query);

    return $s[0];
 }
 function test2(string $query)
 {
    $doc = new DOMDocument;

    $doc->load("config.xml");

    $xpath = new DOMXpath($doc);

    $s = $xpath->query($query);

    return $s[0];
 }

 $query = $p1 . "i" . $p2;

 $s = test1($query);

  var_dump($s);

 echo "abbrev = " . $s->abbrev . "\n";
 echo "name = " . $s->name . "\n";
echo "\n========================\n";

foreach ($s as $key => $value) {
  var_dump($value);
  echo "\n";
}

return;

$html = '<html><body><span class="text">Hello, World!</span></body></html>';

$doc = new DOMDocument();
$doc->loadHTML($html);

$xpath = new DOMXPath($doc);
$span = $xpath->query("//span[@class='text']")->item(0);

echo $span->textContent;

