<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface};
use \SplFileObject as File; 

class UlHtmlBuilder implements ResultfileInterface {

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

       if (count($iter) == 0) {

           return count($iter);
       } 

       $str = "\n<section>";
       
       foreach($iter as $defns)  {

           $str .= '<div class="defn"><h3 class="hwd">';

           $str .= $defns->term ." <span class='pos'>[{$defns->pos}]</span></h3>";    

           // todo: Should the <ul> be within a <p>?    
           $ul_str = $this->build_defns($defns->definitions);
           
           $str .= $ul_str . "</div>";
     }
     
     $str .= "</section>";
     
     $str = $this->tidy( $str ); 

     $this->html->fwrite($str);

     return count($iter); 
   }

   private function build_defns(array $definitions) : string
   {       
        $ul = "<ol class='definitions'>";

        $lis = '';

        foreach ($definitions as $defn) {

             $lis .= "<li>" . $defn["definition"] . "</li>"; 

             if (count($defn['expressions']) > 0) {
                 
                $lis .= "<ul class='expressions'>"; 

                foreach ($defn['expressions'] as $expression) 

                        $lis .= "<li>". $expression->source  . " - ". $expression->target . "</li>";

                $lis .= "</ul>";
             }  
        } 

        $ul .= $lis . "</ol>";     
 
        return $ul;
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
