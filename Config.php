<?php

class Config {

       
    public function __construct(string $args)
    {
       $r = parse_args($args);

       $dom_doc = $this->loadHTML($r->xml); 
    
       $xpath = new \DOMXPath($dom_doc);
    
       // todo: build query based on $r->trans
       $r->trans 
       $nodeList = $xpath->query($query);
             
       if ($nodeList->length == 0) { // ???
    
          // TODO: Trhow exception return 0; 
       } 
    }
       
}
