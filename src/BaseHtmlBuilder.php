<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface, CollinsGermanDictionary};
use \SplFileObject as File; 

class BaseHtmlBuilder implements ResultfileInterface {

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
     
      $gender = trim($this->get_gender($dom));

      $gender = strtoupper($gender);

      $plural = trim($this->get_plural($dom), ",");

      if ($plural !== '')  

            return $gender . "; plural " . $plural;
      else 
            return  $gender;
    }
    
    /*
     * For words Unverständnis, Krähe, Veräter neither query below returns a results.
     */
    private function get_gender(\DOMDocument $dom) : string
    {  
      static $q1 = "//span[@class='gramGrp pos']";
      
      static $q2 = "//span[@class='pos']";

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($q1);
                
      if ($list->count() == 0)

           $list = $xpath->query($q2);
           
      $gender = $list->item(0)->textContent;
      
      if ($list->count() == 2)  
          
           $gender .= ", " . $list->item(1)->textContent . "\n";
         
      return $gender;
   }

   private function get_plural(\DOMDocument $dom) : string
   {
      static $plq = "(//span[@class='orth'])[2]"; // get the second instance of <span class="orth">.

      $xpath = new \DOMXpath($dom);
     
      $list = $xpath->query($plq);
      
      if ($list->count() == 0) 

          return '';
      
      else
          return $list->item(0)->textContent; 
   }

   public function add_definitions($word, string $src, string $dest, string $) : int
   {
      if ($word == 'Unverständnis')
              $debug = 10;
      
      $iter = $this->dict->lookup($word, $src, $dest);
 
      $str = "<section>";
 
      if (count($iter) > 0) {
 
          foreach($iter as $defns)  {
          
             $str .= "<dl class='defn hwd'>\n";
             
            // Test if the word is a noun.Note: Tn the utf-8 (code point collection) lowercase characters
            // have a larger code point values than uppercase.   
             if ($word[0] >= 'A' && $word[0] <= 'Z' ) { 
                 
                $info = $this->get_noun_info($word);       

                $str .= "<dt><p>{$defns->term}</p>\n<p class='pos'>" . $info . "</p></dt>\n";    

             } else 

                $str .= "<dt><p>{$defns->term}</p><p class='pos'>" . strtoupper($defns->pos) . "</p></dt>\n";    
          
             $dd = $this->build_defns($defns->definitions);
             
             $str .= $dd . "</dl>\n";
          }
 
      } else {
          
          $str .= "<dl class='defn' class='hwd'>\n";
          
          $str .= "<dt>$word</dt>\n<dd>No defintions found.</dd></dl>\n";    
      } 
      
      $str .= "\n</section>\n";
      
      // Note: Calling $this->tidy($str) changes <p> tags to <br />.
      $this->html->fwrite($str); 
 
      return count($iter); 
   }
  
   private function build_defns(array $definitions) : string
   {       
      $dd = '';

      foreach ($definitions as $defn) {

           $dd .= "<dd>" . $defn["definition"] . "</dd>\n";

           if (count($defn['expressions']) > 0) {
              
             // We use a nested <dl> for the expressions.
             $dd .= "<dd>\n<dl class='expressions'>\n"; 

              foreach ($defn['expressions'] as $expression) 

                      $dd .= "<dt>{$expression->source}</dt>\n<dd>{$expression->target}</dd>\n";

              $dd .= "</dl>\n</dd>\n";

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
