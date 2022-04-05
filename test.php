<?php
include "Translator.php";

include "AzureTranslator.php";

  $trans = Translator::createTranslator("config.xml", "m");

  $a = array("Guten Tag!", "Geten Morgen");      

  try {
   
    $translation = $trans->translate("Guten Mogen");

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 

