<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\ClassID;
use LanguageTools\RestClient;

include 'vendor/autoload.php';

function test()
{
  try {
   
    $t = RestClient::createClient(ClassID::Systran);
    print_r($t->getDictionaryLanguages());
    print_r($t->getTranslationLanguages());

    $a = array("Wie alt sind Sie?", "Guten Morgen", "Guten Abend");

    foreach ($a as $str) {

        $en = $t->translate($str, 'en', 'de');

        echo "$en\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
}

  try {
   

    test();

   // leipzig_sentences_with_transations($file);
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
