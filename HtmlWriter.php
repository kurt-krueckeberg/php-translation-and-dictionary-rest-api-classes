<?php

class HtmlWriter {

private $header =<<<EOD
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

private $footer =<<<EOF
</div>
</body>
</html>
EOF;

   private $file;
   private $is_closed;

   public function __construct(string $fname)
   {
      $this->file = new SplFileObject($fname, "w");
   
      $this->is_closed = true;
      $this->file->write($header);
   }

   public function write_sentence(string $german, string $english)
   {
      $this->file->write('<p>' . $german . "</p>\n<p>" . $english . "</p>");
   }

   public function close()
   {
       if ($this->is_closed === false) {

	   $this->file->write(footer);
	   $this->is_closed = true;
       } 
   }
}
