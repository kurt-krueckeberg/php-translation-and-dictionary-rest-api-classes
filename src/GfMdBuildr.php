<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface};
use \SplFileObject as File; 

/*
 Github Flavoered Markdown builder.

  Tables:  "If there are a number of cells fewer than the number of cells in the header row, empty cells are inserted. If there are greater, the excess is ignored:"
  see: https://github.github.com/gfm/#example-204



*/

class GfMdBuilder implements ResultfileInterface {
   
   public function add_definitions($word, string $src, string $dest) : int
   {
       $iter = $this->dict->lookup($word, $src, $dest);

       if (count($iter) == 0) {

           return count($iter);
       } 

       $str = "----------\n";
       
       foreach($iter as $defns)  {

           $str .= 'Headword: ' . $defns->term . " [" . strtoupper($defns->pos) . "]\n";    

           $str .= $this->build_defns($defns->definitions);
           
           $str .=  "\n";
     }
     
     echo $str;

     return count($iter); 
   }

   private function build_defns(array $definitions) : string
   {       
       $str = '';

       foreach ($definitions as $defn) {

            $str .= $defn["definition"] . "\n"; 

            if (count($defn['expressions']) > 0) {
                
               $str .= "\texpressions:\n"; 

               foreach ($defn['expressions'] as $expression) 

                       $str .= "\t\t{$expression->source} - {$expression->target}\n";
            }  
        } 

        return $str;
    }

    public function add_samples(string $word, int $cnt) : int 
    {
       $iter = $this->fetcher->fetch($word, $cnt); 

       $str = '';

       if (count($iter) == 0) 

          $str = "There are no sample sentences for " . trim($word) . "."; 

       else 
   
          foreach ($iter as $src) 
   
              $str .= "$src (" . $this->trans->translate($src, $this->dest, $this->src) . ").\n";

       $str .= "\n";

       return count($iter);
    } 

    public function __destruct()
    {
       $this->save();        
    } 

    public function save()
    {
       if (!$this->b_saved) {

            echo "\n"; 
            $this->b_saved = true;
        } 
    }
    
    public function __construct(string $fname, private readonly string $src, private readonly string $dest, private readonly DictionaryInterface $dict, private readonly TranslateInterface $trans, private readonly SentenceFetchInterface $fetcher)
    { 
       $this->b_saved = false;
    }
}
