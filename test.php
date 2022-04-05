<?php
include "Translator.php";

include "AzureTranslator.php";

  $trans = Translator::createFromXML("config.xml", "d");

   $a = array("Guten Tag!", "Geten Morgen");      

  try {
   
    $translation = $trans->translate("Guten Mogen");

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 

