<?php
   $simp = simplexml_load_file("config.xml");

   $q ="/sentence_generation/translation_services/service/abbrev[normalize-space() = 'm']/.."; 

   $service = $simp->xpath($q);

   $s = $service[0];
  /* 
    Use SimpleXML to retieve:
    - headers
    - query string parameters
   */ 
  $this->xml = $s;

   var_dump($this->xml->headers);


