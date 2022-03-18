<?php

include "Translator.php";

$x = Translator::create("config.xml", "m");

$x->translate("Guten Tag!", "de", "en");
