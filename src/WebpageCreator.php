<?php
declare(strict_types=1);
namespace LanguageTools;

use \SplFileObject as File;

class WebpageCreator {

   private $file;
   private $is_closed;

static private $header =<<<EOH
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
   <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
   <link rel="stylesheet" type="text/css" media="screen" href="screen.css">
   <title></title>
</head>
<body>
<section>\n
EOH;

static private $footer =<<<EOF
</section>
</body>
</html>
EOF;

   public function __construct()
   {
      $fname = "examples_" . date("F_j_Y_h_i_s_A") . ".html"; // date("m-d-y:H:i:s") 

      $this->file = new File($fname, "w");
      
      $this->is_closed = false;

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
