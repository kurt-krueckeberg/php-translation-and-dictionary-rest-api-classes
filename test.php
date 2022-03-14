<?php
declare(strict_types=1);

 $p1 = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

 $p2 = "']/.."; 

 function test(string $p1, string $p2)
 {
    $query = $p1 . "i" . $p2;

    $xml = simplexml_load_file("config.xml");

    $s = $xml->xpath($query);

    return $s[0];
 }

$s = test($p1, $p2);

$x = $s["query_string_parms"];

var_dump($x[0]);

echo "\n";
foreach ($s as $key => $value) {
  var_dump($value);
  echo "\n";
}
