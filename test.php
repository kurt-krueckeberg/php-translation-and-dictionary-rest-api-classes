<?php
   $simp = simplexml_load_file("config.xml");

   $q ="/sentence_generation/translation_services/service/abbrev[normalize-space() = 'm']/.."; 

   $service = $simp->xpath($q);

   $s = $service[0];
   var_dump($s->abbrev);
   echo "\n\n";
   var_dump($s->name);
   echo "\n\n";
   var_dump($s->headers);
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


