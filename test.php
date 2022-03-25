<?php
declare(strict_types=1);



  // Alternative query:    "/providers/provide/service/abbrev[normalize-space() = '";

  // 

   /*
    To use access the attributes of an SimpleXMLElement, use the `attibutes()` method like this:


    $xpath_str = "/providers/provide/name[@abbrev='l']";

    $xpath = ....
    $dom = ...

    $service = $dom->query($xpath);

    $serive->attributes()->type
   */  

 function test_simple(string $provider_q, string $abbrev)
 {
    $xml = simplexml_load_file("test.xml");

    $query = sprintf($provider_q, $abbrev);

    $s = $xml->xpath($query);

    return $s[0];
 }
/*
 function test_dom(string $provider_q, string $abbrev)
 {
    $doc = new DOMDocument;

    $doc->load("config.xml");

    $xpath = new DOMXpath($doc);

    $query = sprintf($provider_q, $abbrev);

    $s = $xpath->query($query);

    return $s[0];
 }
*/

 $xml = simplexml_load_file("test.xml");
 
 $provider_q =  "/providers/provider/name[@abbrev='%s']";
 
 $query = sprintf($provider_q, "l");
 
 echo $query . "\b";

  $s = $xml->xpath($query);

  var_dump($s);

  echo "\n===========\n";

  print_r($s);

  return;

 echo "abbrev = " . $s->abbrev . "\n";
 echo "name = " . $s->name . "\n";

echo "\n========================\n";

foreach ($s as $key => $value) {
  echo "Key of $key has node-content of " . $value . "\n";
}

foreach ($s->query_string_parms[0] as $key => $value) {

  echo "Key of $key has node-content of " . $value . "\n";
}
return;

$html = '<html><body><span class="text">Hello, World!</span></body></html>';

$doc = new DOMDocument();
$doc->loadHTML($html);

$xpath = new DOMXPath($doc);
$span = $xpath->query("//span[@class='text']")->item(0);

echo $span->textContent;

