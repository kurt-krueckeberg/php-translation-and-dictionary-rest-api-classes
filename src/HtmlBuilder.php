<?php
declare(strict_types=1);

namespace LanguageTools;
use LanguageTools\SystranDictResult;

class HtmlBuilder {

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


static private string $html = <<<html_start
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>German Words</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="screen.css"> 
    </head>
    <body>
html_start;


static private string $html = <<<html_end
    </body>
</html>
html_end;

   
   public function add_lookup_results(ResultsIterator $iter) 
   {
       $str = "<section>";
       
       foreach($iter as $defns)  {

           $str .= '<div class="defn"><h1 class="hwd">';

           $str .= $defns->term ."<span class='pos'>[ {$defns->pos} ]</span></h1>\n";    

           // todo: Should the <ul> be within a <p>?    
           $ul_str = $this->build_defns($defns->definitions);
           
           $str .= $ul_str . '</div>';
     }
     
     $str .= "</section>";
     
     $str = $this->tidy( $str ); 

     $this->html->fwrite($str); 
   }

    private function build_defns(array $definitions) : string
    {       
        $ul = '<ul class="definitions">';

        $lis = '';

        foreach ($definitions as $defn) {

             $lis .= "<li>" . $defn["definition"] . "</li>"; 

             if (isset($defn["expressions"]) && count($defn['expressions']) > 0) {
                 
                $lis .= "<ul class='expressions'>\n"; 

                foreach ($defn['expressions'] as $expression) 

                        $lis .= "<li>". $expression->source  . " - ". $expression->target . "</li>";

                $lis .= "</ul>";
             }  
        } 

        $ul .= $lis . "</ul>";     
 
        return $ul;
    }


    public function saveHTML
    public function __construct(string $fname)
    { 
       $this->html = new File($fname, "w"); 
    }
}
