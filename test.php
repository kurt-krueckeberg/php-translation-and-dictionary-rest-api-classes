<?php
declare(strict_types=1);
use Translators\Translator;
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;

include "vendor/autoload.php";

$xml = \simplexml_load_file("config.xml");

$trans = Translator::createFromXML($xml, "m");
 
$input = array("Guten Tag!", "Guten Morgen");

try {

  foreach ($input as $text) // Translate into Russian 
     $translation = $trans->translate($text, "RU");

  echo $translation . "\n";
  
  echo "Dictionary lookup:\n";

  echo $trans->lookup("Anlagen", "DE", "EN") . "\n";

} catch (RequestException $e) { 

    // If a response code was set, get it.
    if ($e->hasResponse()) echo "Response Code = " . $e->getResponse()->getStatusCode();

    else echo  "No response from server.";

    echo "\nException: message = " . $e->getMessage() . "\n";

} catch (\Exception $e) {
    
    echo "\nException: message = " . $e->getMessage() . "\n";
} 

