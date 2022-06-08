<?php
declare(strict_types=1);
namespace LanguageTools;

use \SplFileObject as File;

/* Creates a two-column webpage with left column in source language and right in the translated language. CSS is in the <head>
   section of the html output.  */

class WebpageCreator {

     private File $file;
     private bool   $is_closed; 

    // Four properties are defined and promoted to member variables on the constructor

static private $header =<<<EOH
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
   <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
   <title></title>
<style>
EOH;

static private $footer =<<<EOF
</body>
</html>
EOF;

   private bool $is_closed;

   public function __construct(string $fname, string $css)
   {
      $this->file = new File($fname . '.html', "w");
     
      $this->is_closed = ($this->file !== false) ? false : true; 

      $this->file->fwrite(self::$header);

      $this->file->fwrite($css);

      $this->fwrite("</style>\n</head>\n<body>\n");

      // todo: add <section>??
   }

   public function __destruct()
   {
        $this->close();
   }

   /*
    * todo: The specific properties of he \stdClasws that $iter returns vary by translation/dictionary
    * service. This method is for Systran's lookup results. 
    */
   private function write(string $input
   {
       // TOdo: Change to use <section class="definitions"> and  <dt><dl>, etc
       if (count($iter) == 0) {

          echo "no definitions available.\n";  // todo: move this below?
          return;
       }
       
       $this->file->fwrite("<section class='definitions'>\n<dl>\n");
   
       foreach ($iter as $result) {

           // todo: Compare this with PONS and Collins output and try to match it.
           /*
            $this->file->fwrite("<dt>Definitions</dt>\n<dd>&nbsp;</dd>\n"); // todo: is <dt> the best here?
             */

           $this->file->fwrite("<dt>" . $result->term . "</dt>\n<dd>" . $result->pos . "</dd>\n" );
    
           foreach($result->definitions as $index => $definition) {
               
               $i = $index + 1;
               
               $this->file->fwrite("<dt>$i. " . $result->term . "</dt>\n<dd>" . $definition->meaning . "</dd>\n");
    
               /*
               if (count($definition->expressions) != 0)
                   echo "\t\tExpressions:\n";
                */
    
               foreach ($definition->expressions as $key => $expression) {
                   
                   // $i = $key + 1;
                   
                   //echo "\t\t$i. $expression->source\n";
                   $this->file->fwrite( "<dt>" . $expression->source . "</dt><dd>" . $expression->target . "</dt>\n" );
               }
           }
      }
      $this->file->fwrite( "</dl>\n</section>\n");
   } 
 
   private function writeSentences(string $word)
   {
      $this->file->fwrite("<section class=\"sentences\">\n");       

      $iter = $this->fetcher->fetch($word, 3);

      foreach ($iter as $sentence) {
    
            $translation = $this->trans->translate($sentence, $this->to_lang, $this->from_lang); 
            
            $this->file->fwrite('<p>' . $sentence . "</p>\n<p>" . $translation . "</p>\n");
      }

      $this->file->fwrite("</section>\n");       
   }


   private function close()
   {
       if ($this->is_closed === false) {

	   $this->file->fwrite(self::$footer);
	   $this->is_closed = true;
       } 
   }

   public function __invoke(File $file)
   {
      foreach ($file as $word) {
      
          $resultsIter = $this->dict->lookup($word, "DE", "EN");
    
          $this->writeDefinitions($resultsIter, $word);
    
          $sentIter = $this->fetcher->fetch($word, 3);
    
          $this->writeSentences($word);
      }
  } 
}
