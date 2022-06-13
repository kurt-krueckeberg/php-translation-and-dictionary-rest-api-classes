<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface};
use \SplFileObject as File; 

class TxtBuilder implements ResultfileInterface {

   
   
   public function add_definitions($word, string $src, string $dest) : int
   {
       $iter = $this->dict->lookup($word, $src, $dest);

       if (count($iter) == 0) {

           return count($iter);
       } 

       $str = "Definitions:\n";
       
       foreach($iter as $defns)  {

           $str .= 'Headword: ' . $defns->term . " [{$defns->pos}]\n";    

           // todo: Should the <ul> be within a <p>?    
           $ul_str = $this->build_defns($defns->definitions);
           
           $str .=  "\n";
     }
     
     $this->html->fwrite($str);

     return count($iter); 
   }

   private function build_defns(array $definitions) : string
   {       
       $str = '';

       foreach ($definitions as $defn) {

            $str .= $defn["definition"] . "\n"; 

            if (isset($defn["expressions"]) && count($defn['expressions']) > 0) {
                
               $str .= "\n\texpressions:\n"; 

               foreach ($defn['expressions'] as $expression) 

                       $str .= "\t\t{$expression->source} ({$expression->target})\n";
            }  
        } 

        return $str;
    }

    public function add_samples(string $word, int $cnt) : int 
    {
       $iter = $this->fetcher->fetch($word, $cnt); 

       if (count($iter) == 0) {

           return count($iter);
       }

       $str = "\n";

       foreach ($iter as $src) {

           $dest = $this->trans->translate($src, $this->dest, $this->src);

           $str .= "$src&nbsp;&mdash;&nbsp;$dest";
       } 

       $str .= "n";

       $this->file-<fwrite($str);

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
