#!/usr/bin/env php
<?php
declare(strict_types=1);
use Translators\Translator;

include "SentenceFetcher.php";

include "WebPageCreator.php";
include "FileReader.php";

function check_args(array $argv)
{
  if ((strlen($argv[0]) !== 1))
        throw new \Exception("First argument one letter\n");
  else if (!($argv[0] == 'd' ||  $argv[0] == 'm' ||  $argv[0] == 'i'))
        throw new \Exception("First argument must be 'd', 'm' or 'i'");

  if (substr($argv[1], strpos($argv[1], ".")) !== "xml")
        throw new \Exception("2nd argument must be config.xml file");

}
  try {
      if ($argc < 2)
         die("Enter two args\n");
      check_args($argv);
  
  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
