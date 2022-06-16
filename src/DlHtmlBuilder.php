<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface, CollinsGermanDictionary};
use \SplFileObject as File; 

class DlHtmlBuilder implements ResultfileInterface {

static private string $html_start = <<<html_eos
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
        <title>German Vocab</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/dark-vocab.css"> 
    </head>
    <body>
html_eos;

static private string $html_end = <<<html_end
    </body>
</html>
html_end;

  static $noun_start = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
EOS;

   private function tidy(string $html)
   { 
     static $tidy_config = array(
                     'clean' => true,
                     'output-xhtml' => true,
                     'show-body-only' => true,
                     'wrap' => 0,
                     'indent' => true
                     ); 
                     
      $tidy = tidy_parse_string($html, $tidy_config, 'UTF8');

      $tidy->cleanRepair();

      return (string) $tidy;  
   }

  /*
     Get Gender of noun and its plural form
   */ 
   private function get_noun_info($word) : string
   {
      static $q1 = "//span[@class='gramGrp pos']";

      static $q2 = "//span[@class='gramGrp']/span[@class='pos']";

static $noun_start =<<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
    </head>
    <body>
EOS;

      $div = $this->collins->get_best_matching($word);

      $html = $noun_start;

      $html .= $div;

      $html .= '</body.</html>';

      $dom = new \DOMDocument("1.0", 'utf-8');
     
      @$dom->loadHTML($html);
          
      $body = $dom->getElementsByTagName('body')->item(0);
      
      $xpath = new \DOMXpath($dom);
     
      // try the most common query first....
      $nodeList = $xpath->query($q1);
       
      $str = '';
     
      if ($nodeList->count() == 1) { // ...if it fails, we try the other query
     
          $node = $nodeList->item(0); // \DOMText
     
          $str = $node->textContent;
     
      } else {
     
         $nodeList = $xpath->query($q2);
     
         foreach($nodeList as $node) {
     
            $str .= $node->textContent . ', ';
         } 
      }
      // todo: plural queries
      return $str;
   }
 
   public function add_definitions($word, string $src, string $dest) : int
   {

      $iter = $this->dict->lookup($word, $src, $dest);
 
      $str = "<section>";
 
      if (count($iter) > 0) {
 
          foreach($iter as $defns)  {
          
             $str .= '<dl class="defn" class="hwd">';
               
             $gender = '';
           
             if ($word[0] >= 'A' && $word[0] <= 'Z' ) { // In utf-8, the lowercase characters
                             // have a larger code point value than the uppercase.

                $gender = $this->get_noun_info($word);       

                $str .= "<dt>{$defns->term} <span class='pos'>" . strtoupper($gender) . "</span></dt>";    

             } else {
                   $str .= "<dt>{$defns->term} <span class='pos'>" . strtoupper($defns->pos) . "</span></dt>";    

             }
          
             $dd = $this->build_defns($defns->definitions);
             
             $str .= $dd . "</dl>";
          }
 
      } else {
 
          $str .= '<dl class="defn" class="hwd">';
          
          $str .= "<dt>$word</dt><dd>No defintions found.</dd>";    
      } 
      
      $str .= "</section>";
      
      $str = $this->tidy($str); 
 
      $this->html->fwrite($str);
 
      return count($iter); 
   }

  
   private function build_defns(array $definitions) : string
   {       
        $dd = '';

        foreach ($definitions as $defn) {

             $dd .= "<dd>" . $defn["definition"] . "</dd>";

             if (count($defn['expressions']) > 0) {
                
                /* We use a nested <ul> for the expressions.
                $dd .= "<dd><ul class='expressions'>"; 

                foreach ($defn['expressions'] as $expression) 

                        $dd .= "<li>". $expression->source  . " - ". $expression->target . "</li>";

                $dd .= '</ul></dd>';
               */

               // We use a nested <dl> for the expressions.
               $dd .= "<dd><dl class='expressions'>"; 

                foreach ($defn['expressions'] as $expression) 

                        $dd .= "<dt>{$expression->source}</dt><dd>{$expression->target}</dd>";

                $dd .= '</dl></dd>';

             }  
        } 

        return $dd;
    }

    public function add_samples(string $word, int $cnt) : int 
    {
       $iter = $this->fetcher->fetch($word, $cnt); 

       $str = "<section class='samples'>";

       if (count($iter) == 0)

           $str .= "<p>There are no sample sentences for " . trim($word) . '.</p>'; 

       else 
   
          foreach ($iter as $src) 
   
              $str .= "<p>$src</p><p>" . $this->trans->translate($src, $this->dest, $this->src) . "</p>";

       $str .= "</section>";

       $this->html->fwrite($this->tidy($str));

       return count($iter);
    } 

    public function __destruct()
    {
       $this->save();        
    } 

    public function save()
    {
       if (!$this->b_saved) {

            $this->html->fwrite(self::$html_end);
            $this->b_saved = true;
        } 
    }
    
    public function __construct(string $fname, private readonly string $src, private readonly string $dest, private readonly CollinsGermanDictionary $collins, private readonly DictionaryInterface $dict, private readonly TranslateInterface $trans, private readonly SentenceFetchInterface $fetcher)
    { 
       $this->b_saved = false;

       $this->html = new File($fname, "w"); 

       $this->html->fwrite(self::$html_start);
    }
}
