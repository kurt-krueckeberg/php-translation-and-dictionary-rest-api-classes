<?php

class HtmlWriter {

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

   public function __construct(string $fname)
   {
      $this->file = new SplFileObject($fname . ".html", "w");
   
      $this->is_closed = true;
      $this->file->fwrite(self::$header);
   }

   public function __destruct()
   {
        $this->close();
   }

   public function write($german, string $english)
   {
      $this->file->fwrite('<p>' . $german . "</p>\n<p>" . $english . "</p>");
   }

   public function close()
   {
       if ($this->is_closed === false) {

	   $this->file->fwrite(self::$footer);
	   $this->is_closed = true;
       } 
   }
}
