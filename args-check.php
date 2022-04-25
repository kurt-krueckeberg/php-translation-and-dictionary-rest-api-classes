<?php

function check_args(int $argc, array $argv)
{
  if ($argc < 2) {
  
      die ("Enter abbreviation of translation service (i for IBM, m for Microsoft or d for DEEPL),followed by 'config.xml'");
      return;
  }

  if (!file_exists($argv[1]))
       die("The input file does not exist!\n");
}
