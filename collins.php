<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\CollinsGermanDictionary;

include 'vendor/autoload.php';

function test_collins(File $file)
{
  try {
   
    $t = new CollinsGermanDictionary();

$html = <<< EOS
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html lang='de'>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
EOS;

    echo  $html . "\n";
    echo CollinsGermanDictionary::get_css() . "\n";
    echo "</style>\n</head>\n<body>\n";

    foreach ($file as $word) {

        
        $d = $t->get_best_matching($word);

        if (!is_null($d)) {
            echo "$d\n";
        }
    }

     echo "</body>\n</html>\n";
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
}

  try {
   
    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    test_collins($file);

   // leipzig_sentences_with_transations($file);
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
