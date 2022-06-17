<?php
declare(strict_types=1);

use LanguageTools\CollinsGermanDictionary;
use LanguageTools\FileReader as File;

include "vendor/autoload.php";
 
  /*
     Get Gender of noun and its plural form
   */ 
   function get_noun_info($word, CollinsGermanDictionary $collins) : string
   {

static $noun_start =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
    </head>
    <body>
EOS;

      echo "WORD: $word\n";

      $div = $collins->get_best_matching($word);

      $html = $noun_start;

      $html .= $div;

      $html .= '</body.</html>';

      $dom = new \DOMDocument("1.0", 'utf-8');
     
      @$dom->loadHTML($html);
          
      $body = $dom->getElementsByTagName('body')->item(0);
       
      $gender = trim(get_gender($dom));

      $plural = trim(get_plural($dom), ",");
      echo "\tplural: $plural\n------------\n";

      return strtoupper($gender) . ', ' . $plural;
    }
    
    /*
     * For words Unverständnis, Krähe, Veräter neither query below returns a results.
     */
/*
    function get_gender(\DOMDocument $dom) : string
    {  
      static $q1 = "//span[@class='gramGrp pos']";
      
      static $q2 = "//span[@class='pos']";
      static $q3 =  "//span[contains(@class,'pos')]";

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q1);
                
      if ($list->count() == 0) 
           $list = $xpath->query($q2);
            
      if ($list->count() == 0) {
          "\tGender: failed\n----END OF GENDER ------\n";
          return "gender failed";
      }
      
      $gender = $list->item(0)->textContent;
      
      if ($list->count() == 2)  
          
           $gender .= ", " . $list->item(1)->textContent . "\n";
              
      echo "\tGender: $gender\n";
      
      return $gender;
   }
*/
    function get_gender(\DOMDocument $dom) : string
    {  
      static $q =  "//span[contains(@class,'pos')]";

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q);
                
      if ($list->count() == 0) {
          "\tGender: failed\n----END OF GENDER ------\n";
          return "gender failed";
      }
      
      $gender = $list->item(0)->textContent;
      
      if ($list->count() == 2)  
          
           $gender .= ", " . $list->item(1)->textContent . "\n";
              
      echo "\tGender: $gender\n";
      
      return $gender;
   }


   // todo: Thisonly works sometimes. The query must be query 
   function get_plural(\DOMDocument $dom) : string
   {
      //++-- static $plq = "(//span[@class='orth'])[2]"; // get the second instance of <span class="orth">.
      static $plq = "//span[@class='orth']"; // get the second instance of <span class="orth">.

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($plq);
      
      if ($list === false) 
          new \Exception( " XPath query (//span[@class='orth'])[2] failed");
      
      $plural = '';

      if ($list->count() == 0) 
          $plural = "none";

      else 
          
          foreach($list as $node)
              $plural .=  $node->textContent; 
     
      return $plural;
   }



  try {

    if ($argc == 1 || !file_exists($argv[1]))
       die("Enter the input file name.");
   
    $t = new CollinsGermanDictionary();
    $file = new File($argv[1]);

    foreach ($file as $word) {
        
        $word = trim($word);
        
        get_noun_info($word, $t);
        
/*        
        $d = $t->get_best_matching($word);

        if (!is_null($d)) {
            echo "$d\n";
        }
 */
        
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
