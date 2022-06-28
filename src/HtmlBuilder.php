<?php
declare(strict_types=1);

namespace LanguageTools;

use LanguageTools\{ClassID,
DictionaryInterface,
TranslateInterface,
SentenceFetchInterface,
CollinsGermanDictionary,
PonsDictionary,
PonsNounFetcher,
CollinsNounFetcher};

use \SplFileObject as File; 

class HtmlBuilder {

     private File                   $out;
     private NounFetchInterface     $noun_;
     private TranslateInterface     $trans;
     private SentenceFetchInterface $sfetch;
     
     private DictionaryInterface    $dict;

static private string $out_start = <<<html_eos
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
   <head>
      <title>German Vocab</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/vocab.css"> 
   </head>
<body>
html_eos;

static private string $out_end = <<<html_end
    </body>
</html>
html_end;

   private function tidy(string $out)
   { 
     static $tidy_config = array(
                     'clean' => true, 
                     'output-xhtml' => true, 
                     'show-body-only' => true,
                     'wrap' => 0,
                     'indent' => true
                     ); 
                     
      $tidy = tidy_parse_string($out, $tidy_config, 'UTF8');

      $tidy->cleanRepair();

      return (string) $tidy;  
   }
  /*
     Get Gender of noun and its plural form
   */ 
   public function add_definitions(string $word) : int
   {
      static $sec_start =  "<section>\n  <dl class='hwd'>\n";
      static $def_fmt = "  <dt>\n   <ul>\n    <li>%s</li>\n    <li class='pos'>%s</li>\n   </ul>\n  </dt>\n";    

      $sec = $sec_start;

      $iter = $this->dict->lookup($word, $this->src, $this->dest);
 
      if (count($iter) > 0) {
 
          foreach($iter as $result)  {
          
              // Lowecase letters in the utf-8 code point collection
              // have a larger code point values than uppercase characters.
              if ($word[0] >= 'A' && $word[0] <= 'Z' ) { 
                 
                  $info = $this->noun_->get_noun_info($word);  
                  
                  $noun_str = "{$info['article']} {$result->term}";
                  
                  if ($info['plural'] != '') 
                      
                      $noun_str .= ", die  {$info['plural']}"; // German-only code
                  
                  $sec .= sprintf($def_fmt, $result->term, strtoupper($result->pos));

              } else // Not a noun

                  $sec .= sprintf($def_fmt, $result->term, strtoupper($result->pos));
              
                    
              $defns = $this->build_defns($result->definitions);
              
              $sec .= $defns;
           }
           
           $sec .= "\n   </dl>"; 
           
      } else {
          
          $sec .= "\n<dl>$word No defintions found.</dl>\n";    
      } 
      
      $sec .= "\n</section>\n";
      
      $this->out->fwrite($sec);
 
      return count($iter); 
   }
  
   private function build_defns(array $definitions) : string
   {       
      $dds = '';
      static $defn_fmt =  "  <dd>%s</dd>\n";
      static $exp_fmt =  "    <dt>%s</dt>\n    <dd>%s</dd>\n";

      foreach ($definitions as $defn) {

         $dds .= sprintf($defn_fmt, $defn["definition"]);

         if (count($defn['expressions']) == 0) continue;
              
         // We have exprrssion to adda. We use a nested <dl> for the expressions.
         $exps = "  <dd class='expressions'>\n   <dl>\n"; 
         
         foreach ($defn['expressions'] as $expression) 

                $exps .= sprintf($exp_fmt, $expression->source, $expression->target);

         $exps .= "  </dl>\n  </dd>\n";
         
         $dds .=  $exps ;              
      }
      return $dds;
    }


    public function add_samples(string $word, int $cnt) : int 
    {
       static $sec_samples = "<section class='samples'>";

       $iter = $this->sents->fetch($word, $cnt); 

       $str = $sec_samples;

       if (count($iter) == 0)

           $str .= "<p>There are no sample sentsences for " . trim($word) . '.</p>'; 

       else foreach ($iter as $src) 
   
              $str .= "<p>$src</p><p>" . $this->trans->translate($src, $this->dest, $this->src) . "</p>";

       $str .= "</section>";

       $this->out->fwrite($this->tidy($str));

       return count($iter);
    } 

    public function __destruct()
    {
       $this->save();        
    } 

    public function save()
    {
       if (!$this->b_saved) {

            $this->out->fwrite(self::$out_end);
            $this->b_saved = true;
        } 
    }
    
    public function __construct(string $ofname, string $src, string $dest, ClassID $dict_id)
    { 
       $this->dict = $this->trans = RestClient::createClient(ClassID::Systran);

       $this->noun_ = ($dict_id == ClassID::Pons) ? new PonsNounFetcher(new PonsDictionary()) : new CollinsNounFetcher(new CollinsGermanDictionary());    
       
       $this->sents = new LeipzigSentenceFetcher(ClassID::Leipzig);

       $this->b_saved = false;
       
       $this->src = $src;
       
       $this->dest = $dest;

       $this->out = new File($ofname . ".html", "w"); 

       $this->out->fwrite(self::$out_start);
    }
}
