<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\CollinsGermanDictionary;

include 'vendor/autoload.php';

function test_collins(File $file)
{
  try {
   
    $t = new CollinsGermanDictionary();
        
        $d = $t->get_best_matching('erzeugen');

        if (!is_null($d)) {
            echo "$d\n";
        }

     echo "</body>\n</html>\n";
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
}

  try {
   
    $file =  new File("vocab.txt");
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    test_collins($file);

   // leipzig_sentences_with_transations($file);
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
