<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\{DictionaryInterface, TranslateInterface, SentenceFetchInterface, CollinsGermanDictionary};
use \SplFileObject as File; 

class HtmlBuilder implements ResultfileInterface {

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
   public function add_definitions($word, string $src, string $dest) : int
   {
      // We use a definitin list of class "hwd", headword, to display definitions. For those invidual 
      // definitions that have associated expressions, we use  a nested <dl class="expressions">.
      // associated with a given definition.
      // The word, a new 'head word': hwd
      static $ul_hwd =  "<ul class='defns'>\n";

      $iter = $this->dict->lookup($word, $src, $dest);
 
      $sec = "<section>\n";

      echo "Section Start:\n$sec\n";
 
      if (count($iter) > 0) {
 
          foreach($iter as $set)  {
          
              // If Noun (Tn the utf-8 (code point collection) lowercase characters
              // have a larger code point values than uppercase)   
              if ($word[0] >= 'A' && $word[0] <= 'Z' ) { 
                 
                  $info = $this->get_noun_info($word);       

                  $sec .= "<div class='hwd'><p>{$set->term}</p><p class='pos'>{$info['gender']} {$info['plural']}</p>\n";    

              } else // Not a noun

                  $sec .= "<div class='hwd'><p>{$set->term}</p><p class='pos'>" . strtoupper($set->pos) . "</p>\n";    
                  
              $defns = $this->build_defns($set->definitions);

              $sec .= $defns;
           }
           
           $sec .= $sec . '</ul>'; // append definitions
           
      } else {
          
          $sec .= "<div><p>$word No defintions found.</p></div>\n";    
      } 
      
      $sec .= "</div>\n</section>\n";

      echo "Section End:\n$sec\n";

      // Note: Calling $this->tidy($str) changes <p> tags to <br />.
      $this->html->fwrite($sec );
 
      return count($iter); 
   }
  
   private function build_defns(array $definitions) : string
   {       
      static $ul_defn = "<ul class='defn'>";
      static $dl = "<dl class='expressions'>";

      $ul = $ul_defn;

      foreach ($definitions as $defn) {

          $ul .= "<li>" . $defn["definition"] . "</li>\n";

          if (count($defn['expressions']) > 0) { // Build expression <dl>
               
              // We use a nested <dl> for the expressions.
              $li_exp = "<li class='expressions'>\n$dl\n"; 
              
              $rows = ''; 
              
              foreach ($defn['expressions'] as $expression) 

                     $rows .= "    <dt>{$expression->source}</dt>\n    <dd>{$expression->target}</dd>\n";

              $li_exp .= "$rows</dl>\n</li>\n";
              
               $ul .=  $li_exp;              
          }                   
      }
      
      $ul .= "</ul>\n";  
      return $ul;
    }

    public function add_samples(string $word, int $cnt) : int 
    {
       static $sec_samples = "<section class='samples'>";

       $iter = $this->sfetcher->fetch($word, $cnt); 

       $str = $sec_samples;

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
    
    public function create(string $fname, string $src, string $dest, ClassID $dict_id)
    { 
        $t = new SystranTranslator();

        if ($dict_id == ClassID::Pons)

             $d = new PonsDictionary()
             $f = new PonsNounFetcher($d);  

        } else if ($dict_id == ClassID::Collins) {

             $d = new CollinsGermanDictionary()
             $f = new CollinsNounFetcher($d);  
        }

        $f = new FileReader($fname); 

        return new HtmlBuilder($f, $src, $dest, $t, $f);
    }

    public function __construct(private readonly FileReader $f, private readonly string $src, private readonly string $dest, private readonly TranslateInterface $trans, private readonly NounFetchInterface $nfetch,  private readonly SentenceFetchInterface $sfetcher)
    { 
       $this->b_saved = false;

       $this->html = new File($fname, "w"); 

       $this->html->fwrite(self::$html_start);
    }
}
