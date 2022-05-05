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
body {
  margin-left: 3em;
  color: #FFFFFF;  
  background-color: #002451;

  /* Alternate colors: 
  color: #FFFFFF;  
  background-color: #102450;

  color: black;        
  background-color: white;   

  color: #D0CFCC;              
  background-color: #171421;  
  */
}

/*
section dl {

  display: grid; 
  width: 60%;
  margin: auto;
  grid-template-columns: auto auto;
  column-gap: 10px;
 
}
*/

section.sentences, section.definitions dl { /* paragraph style: font and spacing within paragraph lines and between paragraphs */
  display: grid; 
  width: 60%;
  margin: auto;
  grid-template-columns: auto auto;
  column-gap: 10px;

  font-family: 'Lato Medium', Arial, sans-serif;

}

section.sentences p, section.definitions dt, section.definitions dd { ?* tod: This is not working for dt and dd */

  padding-top: 3px;
  padding-bottom: 3px;
  padding-right: 6px;
  line-height: 1.7em; /* <--- Spacing between lines in paragraph */ 
  margin: 4px 0;      /* <--- Spacing between paragraphs. Equivalent to: 
    
             margin-top: 7px;
             margin-bottom: 7px;
             margin-left: 0px;
             margin-right: 0px;  
            */
}

section.sentences p:hover {

	background-color:  #1a346c; 
}	

h1, h2, h3, h4, h5 {

  font-family: 'Karla Semibold', 'Open Sans', Arial, sans-serif;
}

table {
  border-collapse: collapse;
  width: 100%;
}

table td, table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
EOH;

static private $footer =<<<EOF
</body>
</html>
EOF;

   public function __construct(private SentenceFetchInterface $fetcher, private TranslateInterface $trans, private DictionaryInterface $dict, private string $from_lang, private string $to_lang, string $fname)
   {
      $this->is_closed = false; 

      $this->file = new File($fname . '.html', "w");

      $this->file->fwrite(self::$header);
   }

   public function __destruct()
   {
        $this->close();
   }

   private function writeDefinitions(ResultsIterator $iter, string $word)
   {
       // TOdo: Change to use <section class="definitions"> and  <dt><dl>, etc
       if (count($iter) == 0) {

          echo "no definitions available.\n";
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
