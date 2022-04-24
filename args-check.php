<?php

function check_args(int $argc, array $argv)
{
  if ($argc < 2) {
  
      die ("Enter abbreviation of translation service (i for IBM, m for Microsoft or d for DEEPL),followed by 'config.xml'");
      return;
  }

  if (!file_exists($argv[1]))
       die("The input file does not exist!\n");
/* 
  This is a client coding option not a cmd line argument

  if ( (strlen($argv[1]) !== 1) || ($argv[1] !== 'd' &&  $argv[1] !== 'm' && $argv[1] !== 'i' ) )
      die ("First argument must be 'd', 'm' or 'i'");
*/
}
