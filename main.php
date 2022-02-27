<?php
// TODO:
// Add my code to copmoser so an autoloader can be generated
include "DeeplTranslator.php";

 /*
  * Read config file get:
  * 1. api_key
  * 2. source_lang
  * 3. target_lang
  * 4. File of words for which we want sentences generated.
  */  
 $trans = new DeeplTranslator("7482c761-0429-6c34-766e-fddd88c247f9:fx");

$r = $trans->translate("Ich interessiere mich für Politik.");

echo $r . "\n";
