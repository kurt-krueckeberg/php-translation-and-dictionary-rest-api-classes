<?php
declare(strict_types=1);
namespace LanguageTools;

use \SplFileObject as File;

/* Creates a two-column webpage with left column in source language and right in the translated language. CSS is in the <head>
   section of the html output.  */

class WebpageCreator {

     private string $file;
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

section.grid {

  display: grid; 
  width: 60%;
  margin: auto;
  grid-template-columns: auto auto;
  column-gap: 10px;
 /* padding-left: 2em; */
}

section.grid p { /* paragraph style: font and spacing within paragraph lines and between paragraphs */

  font-family: 'Lato Medium', Arial, sans-serif;

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

section.grid p:hover {
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
<section>\n
EOH;

static private $footer =<<<EOF
</section>
</body>
</html>
EOF;

   public function __construct(private LanguageTools\SentenceFetchInterface $fetcher, private LanguageTools\TranslateInterface $trans, private LanguaeTools\Dictionary $dict, private string $from_lang, private string $to_lang, string $fname)
   {
      $this->is_closed = false; 

      $this->file = new File($fname + .'html', "w");

      $this->file->fwrite(self::$header);
   }

   final private function __destruct()
   {
        $this->close();
   }

   final private function writeDefinitions(ResultsIterator $iter, string $word)
   {
       // TOdo: Change to use <section class="definitions"> and  <dt><dl>, etc
       if (count($iter) == 0) {

          echo "no definitions available.\n";
          return;
       }
     
       foreach ($iter as $result) {
            
           echo "\tTerm:  $result->term [$result->pos]\n";
    
           echo "\tMeanings:\n";
    
           foreach($result->definitions as $index => $definition) {
               
               $i = $index + 1;
               
               echo "\t$i. $definition->meaning\n";
    
               if (count($definition->expressions) != 0)
                   echo "\t\tExpressions:\n";
    
               foreach ($definition->expressions as $key => $expression) {
                   
                   $i = $key + 1;
                   
                   //echo "\t\t$i. $expression->source\n";
                   echo "\t\t$i. $expression->source [$expression->target]\n";
               }
           }
           echo "\n";
      }
      echo "\n";
   } 
 
   final private function writeSentences(string $word)
   {
      $this->file->fwrite("<section class="grid">\n");       

      $iter = $this->fetcher->fetch($word, 3);

      foreach ($iter as $sentence) {
    
            $translation = $trans->translate($sentence, $this->to_lang, $this->from_lang); 
            
            $this->file->fwrite('<p>' . $input . "</p>\n<p>" . $translation . "</p>\n");
      }

      $this->file->fwrite("</section>");       
   }


   final private function close()
   {
       if ($this->is_closed === false) {

	   $this->file->fwrite(self::$footer);
	   $this->is_closed = true;
       } 
   }

   final public function __invoke(File $file)
   {
      foreach ($file as $word) {
      
          $resultsIter = $dict->lookup($word, "DE", "EN");
    
          $this->writeDefinitions($resultsIter, $word);
    
          $sentIter = $fetcher->fetch($word, 3);
    
          $this->writeSentences($sentIter, $word, $trans);
      }
  } 
}
