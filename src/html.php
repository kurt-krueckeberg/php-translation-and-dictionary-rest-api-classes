<?php
declare(strict_types=1);

namespace LanguageTools;
use LanguageTools\SystranDictResult;

class HtmlBuilder {

static private string $html = <<<html_start
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>TODO supply a title</title>
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

   
   public function add_lookup_results(string $word, ResultsIterator $iter) 
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
     
     // todo: $this->tidy($str). See other .php file that uses tidy.   
     return $str;
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

    public function __construct(string $fname)
    { 
       $this->html = new File($fname, "w"); 
    }
}
