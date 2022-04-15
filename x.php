<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\PonsDictionary;
use LanguageTools\WebpageCreator;
use LanguageTools\Translator;

include 'vendor/autoload.php';

  try {

        $d = new PonsDictionary();

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
