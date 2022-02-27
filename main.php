<?php

include "DeeplTranslator.php";


 $trans = new DeeplTranslator("7482c761-0429-6c34-766e-fddd88c247f9:fx");

$r = $trans->translate();

var_dump($r);
