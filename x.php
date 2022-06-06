<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\CollinsGermanDictionary;

include 'vendor/autoload.php';

function pretty(string $h) : string
{
  $dom = new DOMDocument();

  $dom->preserveWhiteSpace = false;
  
  @$dom->loadHTML($h,LIBXML_HTML_NOIMPLIED);
  
  $dom->formatOutput = true;

  return $dom->saveXML($dom->documentElement);
}

function test_collins(File $file)
{
  try {
   
    $file->rewind();

    $t = new CollinsGermanDictionary();

    foreach ($file as $word) {

        $d = $t->get_best_matching($word);

        if (!is_null($d)) {
            echo pretty($d);
        }
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
}

    try {

      $file = new File("x.txt");
 
      test_collins($file);

   // leipzig_sentences_with_transations($file);
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
