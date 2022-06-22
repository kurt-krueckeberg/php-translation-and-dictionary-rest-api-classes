<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\CollinsGermanDictionary;

class CollinsNounFetcher implements NounFetchInterface  {
      
   private CollinsGermanDictionary $collins;
     
   public function __construct(CollinsGermanDictionary$dict)
   {   
      $this->collins = $dict;
   }      

   private function create_dom(string $div) : \DOMDocument
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
     
      $html .= $div . '</body.</html>';

      @$dom->loadHTML($html);

      return $dom; 
    }

    public function get_noun_info(string $word) : array
    {
       $div = $this->collins->get_best_matching($word);

       // todo: what if word is not found in dictionary?
     
       $dom = $this->create_dom($div);
        
       return array('gender' => $this->get_gender($dom), 'plural' => $this->get_plural($dom) ); 
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
      
      return trim($gender);
   }

   private function get_plural(\DOMDocument $dom) : string
   {
      static $q = "(//span[@class='orth'])[2]"; // get the second instance of <span class="orth">.

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q);
      
      if ($list->count() == 0) // no plural found. 

          return '';
      
      else
          return $list->item(0)->textContent; 
   }
}
