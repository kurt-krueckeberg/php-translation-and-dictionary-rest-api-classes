<?php
   $simp = simplexml_load_file("config.xml");

   $q ="/sentence_generation/translation_services/service/abbrev[normalize-space() = 'm']/.."; 

   $service = $simp->xpath($q);

   $s = $service[0];
   
   echo $s->abbrev;
   
   echo "\n\n";
   
   echo $s->name;
   
   echo "\n\n";
   
   foreach($s->headers->header as $header) {
       
       echo "Header name: value = " . $header->name . ": ". $header->value . "\n";
       
    }
   
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


