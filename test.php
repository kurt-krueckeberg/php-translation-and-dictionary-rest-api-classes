<?php
declare(strict_types=1);
use Translators\Translator;
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;

include "vendor/autoload.php";

  $trans = Translator::createFromXML("config.xml", "m");

   $a = array("Guten Tag!");

  try {
   
    $translation = $trans->translate("Guten Morgen", "RU");

    echo $translation . "\n";

  } catch (RequestException $e) { // We get here if the response code from the Leipzig server is > 400 (or if it times out)

      /* If a response code was set, get it. */
      if ($e->hasResponse())
          
         echo "Response Code is " . $e->getResponse()->getStatusCode();
      else 
         echo  "No respons from server.";

       echo "\nException: message = " . $e->getMessage() . "\n";

  } catch (\Exception $e) {
      
      echo "\nException: message = " . $e->getMessage() . "\n";
  } 

