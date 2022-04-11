<?php
declare(strict_types=1);
use Translators\Translator;
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;

include "vendor/autoload.php";

$trans = Translator::createFromXML("config.xml", "d");

$input = array("Guten Tag!", "Guten Morgen");

try {

  foreach ($input as $text) // Translate into Russian 
     $translation = $trans->translate($text, "RU");

  echo $translation . "\n";

} catch (RequestException $e) { 

    // If a response code was set, get it.
    if ($e->hasResponse()) echo "Response Code = " . $e->getResponse()->getStatusCode();

    else echo  "No response from server.";

    echo "\nException: message = " . $e->getMessage() . "\n";

} catch (\Exception $e) {
    
    echo "\nException: message = " . $e->getMessage() . "\n";
} 

