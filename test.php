<?php

function display($v)
{
  echo $v . "\n";
}

class Test {

    static $xquerys = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

    static $xquerye = "']/.."; 

    private $endpoint; 
    
    private $client; // <-- new \Guzzle\Client
    
    private $request_method;

    private $headers = array();
    private $query_str = array();
   
    private function get_service(string $xml_fname, string $abbrev)
    {
       $simp = simplexml_load_file($xml_fname);
       
       //Test::$xquery

       $query = self::$xquerys . $abbrev . self::$xquerye;

       $service = $simp->xpath($query); // todo: return $simp->xpath($query)[0];  ??
 
       return $service[0];
    }


   public function __construct(string $fxml, string $service) 
   {
      $service = $this->get_service($fxml, $service); 

      foreach($service->headers->header as $header) {

          //$this->headers[$header->name] = $header->value; 
          var_dump($header->name[0]);
          var_dump( $header->value ); 
      }
   
      $this->baseurl = $service->baseurl;
      
      $this->endpoint = $service->endpoint;
      
      $this->request_method = $service->request_method;
      return;
      
      foreach ($this->service->query_string as $qs)  $this->query_str[$qs->name] = $qs->value;
           
      // $body = $this->get_body(...);  

     //++ $this->client = new Client(array('base_uri' => $this->base_url(), 'headers' => $headers, 'query' => $query); 
   }

   public function __toString()
   {

   }
}

 $x = new Test("./config.xml", "m");
/*
   $q ="/sentence_generation/translation_services/service/abbrev[normalize-space() = 'm']/.."; 

   $service = $simp->xpath($q);

   $s = $service[0];
   
   display($s->abbrev);
   
   display($s->name);
   
   
   foreach($s->headers->header as $header) 
       
        $header->name . ": Header value = ". display($header->value);
   
    return;

  $xml = $s;

   //var_dump($xml->headers);
   
   echo "\n\n";
   
   var_dump($xml->headers[0]);
*/
