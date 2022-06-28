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
     
      $div = $this->collins->lookup($word);

      @$dom->loadHTML($html . $div . '</body.</html>');

      return $dom; 
    }
    
    public function get_noun_info(string $word) : array
    {  
      static $q_gender = "//span[contains(@class,'pos')]"; 

      // The plural is the second instance of <span class="orth">.
      static $q_pl = "(//span[@class='orth'])[2]";       
      
      $dom = $this->create_dom($word);

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q_gender);
                
      $gender = $list->item(0)->textContent;
      
      if ($list->count() == 2)  
          
           $gender .= ", " . $list->item(1)->textContent . "\n";
      
      $gender = trim($gender);
      
      if ($gender[0] == 'f')

          $article = "die";

      else if ($gender[0] == 'n')

           $article = 'das';

      else 
           $article = 'der'; 

      $list = $xpath->query($q_pl);

      $plural = ($list->count() !== 0) ? $list->item(0)->textContent : "";
      
      $plural = trim($plural, ", ");

      return array('gender' => $gender, 'article' => $article, 'plural' => $plural);
   }
}
