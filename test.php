<?php

function display($v)
{
  echo $v . "\n";
}
   $simp = simplexml_load_file("config.xml");

   $q ="/sentence_generation/translation_services/service/abbrev[normalize-space() = 'm']/.."; 

   $service = $simp->xpath($q);

   $s = $service[0];
   
   display($s->abbrev);
   
   display($s->name);
   
   
   foreach($s->headers->header as $header) 
       
        $header->name . ": Header value = ". display($header->value);
   
    return;
  /* 
    Use SimpleXML to retieve:
    - headers
    - query string parameters
   */ 
  $xml = $s;

   //var_dump($xml->headers);
   
   echo "\n\n";
   
   var_dump($xml->headers[0]);


