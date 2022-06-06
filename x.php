<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\CollinsGermanDictionary;

include "vendor/autoload.php";

function test_collins(string $fname)
{
  try {
   
    $file =  new File("new-words.txt");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    $t = new CollinsGermanDictionary();

    $regex = "(</[^>]\+>)";
    $rep = "\n$1";

    foreach ($file as $word) {

        $html = $t->get_best_matching($word);

        if (is_null($html))
            continue;
  
        $html = preg_replace($regex, $rep, $html);

        echo "$html\n"; 
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
}

test_collins("new-words.txt");
