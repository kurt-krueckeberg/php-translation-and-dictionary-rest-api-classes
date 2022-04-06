<?php
declare(strict_types=1);
use Translators\Translator;

include "vendor/autoload.php";

//include "AzureTranslator.php";

  $trans = Translator::createFromXML("config.xml", "m");

   $a = array("Guten Tag!", "Geten Morgen");      

  try {
   
    $translation = $trans->translate("Guten Mogen");
    echo $translation . "\n";

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 

