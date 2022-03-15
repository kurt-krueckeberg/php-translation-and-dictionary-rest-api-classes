<?php

    private function com_create_guid() 
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
  
    private function build_header($key, $region) 
    {
          $headers =  [
                'Content-type' => 'application/json; UTF-8',
                'Content-length' =>  strlen($content),
                'Ocp-Apim-Subscription-Key' => '$key',
                'Ocp-Apim-Subscription-Region' => '$region' ,
                'X-ClientTraceId' => '' , $this->com_create_guid()
            ];
    }  

    // NOTE: Use the key 'http' even if you are making an HTTPS request. See:
    // http://php.net/manual/en/function.stream-context-create.php
    $options = array (
        'http' => array (
            'header' => $headers,
            'method' => 'POST',
            'content' => $content
        )
    );


