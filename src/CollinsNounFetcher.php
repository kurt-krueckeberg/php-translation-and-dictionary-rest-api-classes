<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\CollinsGermanDictionary;

class CollinsNounFetcher implements NounFetchInterface  {
      
   private CollinsGermanDictionary $collins;
     
   public function __construct(CollinsGermanDictionary $dict)
   {   
      $this->collins = $dict;
   }      

   private function create_dom(string $word) : \DOMDocument
   {
static $html =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
    </head>
    <body>
EOS;

      $dom = new \DOMDocument("1.0", 'utf-8');
     
      $div = $this->collins->get_best_matching($word);

      $html .= $div . '</body.</html>';

      $dom->loadHTML($html);

      return $dom; 
    }
    
    public function get_noun_info(string $word) : array
    {  
      static $q_gender = "//span[contains(@class,'pos')]";
      static $q_pl = "(//span[@class='orth'])[2]"; // get the second instance of <span class="orth">.
      

      $dom = $this->create_dom($word);

      echo "==============> \ndiv = \n$div";

      echo "\n\n"; 
      
      echo "================> DOM::textContent\n";

      echo $dom->textContent;

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q_gender);
                
      $gender = $list->item(0)->textContent;
      
      if ($list->count() == 2)  
          
           $gender .= ", " . $list->item(1)->textContent . "\n";
      
      $a = array('gender' => $gender, 'plural' => 'b');
      return $a;
    }

/*

      $dom = $this->create_dom($div);

      echo "==============> \ndiv = \n$div";

      echo "\n\n"; 
      
      echo "================> DOM::textContent\n";

      echo $dom->textContent;

      echo "\n\n";

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q_gender);
                
      $gender = $list->item(0)->textContent;
      
      if ($list->count() == 2)  
          
           $gender .= ", " . $list->item(1)->textContent . "\n";
      
      $gender = trim($gender);

      echo "GENDER = $gender\n\n;
      
      $list = $xpath->query($q_pl);

      $plural = '';
       
      $a = array('gender' => $gender, 'plural' => $plural);

      $plural = ($list->count() !== 0) ? $list->item(0)->textContent;

      return $a;
   }
*/
}
