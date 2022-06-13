<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface};
use \SplFileObject as File; 

class DlBuilder implements ResultfileInterface {

static private string $html_start = <<<html_eos
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

       if (count($iter) == 0) {

           return count($iter);
       } 

       $str = "\n<section>";
       
       foreach($iter as $defns)  {

           $str .= '<dl class="defn" class="hwd">';

           $str .= "<dt>{$defns->term} <span class='pos'>[{$defns->pos}]</span></dt>";    

           $dd = $this->build_defns($defns->definitions);
           
           $str .= $dd . "</dl>";
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
                 
                $dd .= "<dd><ul class='expressions'>"; 

                foreach ($defn['expressions'] as $expression) 

                        $dd .= "<li>". $expression->source  . " - ". $expression->target . "</li>";

                $dd .= '</ul></dd>';
             }  
        } 

        return $dd;
    }

    public function add_samples(string $word, int $cnt) : int 
    {
       $iter = $this->fetcher->fetch($word, $cnt); 

       if (count($iter) == 0) {

           return count($iter);
       }

       $str = "\n<section class='samples'>\n";

       foreach ($iter as $src) {

           $dest = $this->trans->translate($src, $this->dest, $this->src);

           $str .= "<p>$src</p><p>$dest</p>";
       } 

       $str .= "</section>\n";

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
