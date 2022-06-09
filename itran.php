<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\TranTranslator;
use LanguageTools\RestClient;
use LanguageTools\ClassID;

include 'vendor/autoload.php';

try {
   
    $t = RestClient::createClient(ClassID::iTranslate); 

    $in = ['Guten Morgen', 'Guten Abend'];

    foreach ($in as $de) {
        
        $en = $t->translate($de, 'en', 'de');

        echo "$en\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\n";
  } 
