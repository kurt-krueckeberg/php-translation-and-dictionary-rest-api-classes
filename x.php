<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\WebPageCreator as WebPageCreator;

include "vendor/autoload.php";

function check_args(int $argc, array $argv)
{
  if ($argc < 2)
      die ("Enter file with the list of words.\n");

  if (!file_exists($argv[1]))
       die("Input file " . $argv[1] . " does not exist!\n");

  if (!file_exists("config.xml"))
       die("config.xml not found in current directory.\n");
}

 $x = new WebPageCreator("abc");
    $xml = \simplexml_load_file("config.xml");
   $creator = new SentenceFetcher($xml);

