<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\CollinsGermanDictionary;

class CollinsNounFetcher implements NounFetchInterface  {
      
      private \DOMDocument $dom;
      private CollinsGermanDictionary $collins;
     
      private \DOMNode $body;

      private \DOMXpath $xpath;

   public function __construct(CollinsGermanDictionary$dict)
   {   
static $html =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
  <head>
  </head>
EOS;

     /*
        todo: Move the CollinsGermanDictionary::get_noun_info()
        code here and implement the NounFetchInterace method with it.  
      */
      $this->collins = $dict;

      $this->dom = new \DOMDocument("1.0", 'utf-8');
    }      
    

   public function get_plural(string $word) : string | null
   {
        return null;
   }

   public function get_gender(string $word) : string | null
   {       
   }

   private function create_dom($word) : \DOMDocument
   {
static $html =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
    </head>
    <body>
EOS;

      $html .= $this->collins->get_best_matching($word);

      $html .= '</body.</html>';

      $dom = new \DOMDocument("1.0", 'utf-8');
     
      @$dom->loadHTML($html);

      return $dom; 
    }
          
    /*
     * For words Unverständnis, Krähe, Veräter neither query below returns a results.
     */
    private function get_gender(\DOMDocument $dom) : string
    {  
      static $q =  "//span[contains(@class,'pos')]";

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q);
                
      $gender = $list->item(0)->textContent;
      
      if ($list->count() == 2)  
          
           $gender .= ", " . $list->item(1)->textContent . "\n";
      
      $gender = trim($gender);
        
      return $gender;
   }

   private function get_plural(\DOMDocument $dom) : string | null
   {
      static $plq = "(//span[@class='orth'])[2]"; // get the second instance of <span class="orth">.

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($plq);
      
      if ($list->count() == 0) 

          return null;
      
      else
          return $list->item(0)->textContent; 
   }


}
