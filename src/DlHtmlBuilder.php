<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface};
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
        <link rel="stylesheet" type="text/css" href="screen.css"> 
    </head>
    <body>
html_eos;

static private string $html_end = <<<html_end
    </body>
</html>
html_end;

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
 
   public function add_definitions($word, string $src, string $dest) : int
   {
      $iter = $this->dict->lookup($word, $src, $dest);
 
      $str = "<section>";
 
      if (count($iter) > 0) {
 
          foreach($iter as $defns)  {
          
             $str .= '<dl class="defn" class="hwd">';
          
             $str .= "<dt>{$defns->term} <span class='pos'>" . strtoupper($defns->pos) . "</span></dt>";    
          
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
    
    public function __construct(string $fname, private readonly string $src, private readonly string $dest, private readonly DictionaryInterface $dict, private readonly TranslateInterface $trans, private readonly SentenceFetchInterface $fetcher)
    { 
       $this->b_saved = false;

       $this->html = new File($fname, "w"); 

       $this->html->fwrite(self::$html_start);
    }
}
