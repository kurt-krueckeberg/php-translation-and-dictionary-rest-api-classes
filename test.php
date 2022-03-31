<?php
include "Translator.php";

  $trans = Translator::createTranslator("config.xml", "d");

  $a = array("Guten Tag!", "Geten Morgen");      

  try {
         
   foreach ($sentences as $sentence) {
   
         $translation = $trans->translate($sentence, 'DE',  'EN');
   }

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 

