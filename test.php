<?php
declare(strict_types=1);
use Translators\Translator;
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;

include "vendor/autoload.php";

  echo "First add your keys to sample-config.xml. Then rename it config.xml\n";
  return;

  $trans = Translator::createFromXML("config.xml", "m");

   $a = array("Guten Tag!");

  try {
   
    $translation = $trans->translate("Guten Morgen", "RU");

    echo $translation . "\n";

  }  catch (\Exception $e) {
      
      echo "\nException: message = " . $e->getMessage() . "\n";
  } 

