<?php
declare(strict_types=1);
namespace LanguageTools;

use \SplFileObject as File;

/* Creates a two-column webpage with left column in source language and right in the translated language. CSS is in the <head>
   section of the html output.  */

class WebpageCreator {

     private string $file;
     private bool $is_closed; 

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

section {

  display: grid; 
  width: 60%;
  margin: auto;
  grid-template-columns: auto auto;
  column-gap: 10px;
 /* padding-left: 2em; */
}

section p { /* paragraph style: font and spacing within paragraph lines and between paragraphs */

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

section p:hover {
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

   public function __construct(string $name)
   {
      //$fname = "output_" . date("F_j_Y_h_i_s_A") . ".html"; // date("m-d-y:H:i:s") 

      $fname = $name . ".html"; 

      $this->is_closed = false; 

      $this->file = new File($fname, "w");

      $this->file->fwrite(self::$header);
   }

   public function __destruct()
   {
        $this->close();
   }

   public function write(string $input, string $translation)
   {
      $this->file->fwrite('<p>' . $input . "</p>\n<p>" . $translation . "</p>\n");
   }

   public function close()
   {
       if ($this->is_closed === false) {

	   $this->file->fwrite(self::$footer);
	   $this->is_closed = true;
       } 
   }
}
