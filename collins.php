<?php
declare(strict_types=1);

use LanguageTools\CollinsGermanDictionary;

use LanguageTools\FileReader as File;

include "vendor/autoload.php";

  try {
   
    $t = new CollinsGermanDictionary();
    $file = new File("new-words.txt");

    foreach ($file as $word) {

        $d = $t->get_best_matching($word);

        if (!is_null($d)) {
            echo "$d\n";
        }
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
