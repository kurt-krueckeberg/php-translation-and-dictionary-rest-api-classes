<?php
declare(strict_types=1);

use \SplFileObject as File;

class WebPageCreator {

   private $file;
   private $is_closed;

static private $header =<<<EOH
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
   <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
   <link rel="stylesheet" type="text/css" media="screen" href="columns-style.css">
   <title></title>
</head>
<body>
<div id="container">
EOH;

static private $footer =<<<EOF
</div>
</body>
</html>
EOF;

   public function __construct()
   {
      $fname = "examples_" . date("m-d-y:H:i:s") .  ".html";

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
