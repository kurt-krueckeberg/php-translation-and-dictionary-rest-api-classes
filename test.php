<?php
declare(strict_types=1);
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;
use LanguageTools\Translator;
use LanguageTools\RestClient;

include "vendor/autoload.php";

  try {

    $xml = \simplexml_load_file("config.xml");
   
    $s = RestClient::createRestClient($xml, "l");
    
    $iter = $s->fetch("Anlagen", 3);
    
    foreach ($iter as $x) {
        
        echo "Example Sentence for Anlagen: " . $x . "\n";
    }
    return;
    
    $trans = RestClient::createRestClient($xml, "d");
    
    
    
    $input = array("Guten Tag!", "Guten Morgen");

    // Translate into Russian (RU) from German (DE). 
    foreach ($input as $text) { 
             
       $translation = $trans->translate($text, "RU", "DE");
  
       echo "Translation of $text is: $translation\n";
    }
    return;
 
    echo "Dictionary lookup: ";
  
    // look up English definition of German (DE) word "Anlagen"
    echo $trans->lookup("Anlagen", "DE", "EN") . "\n";
  
  } catch (RequestException $e) { 
  
      // If a response code was set, get it.
      if ($e->hasResponse()) echo "Response Code = " . $e->getResponse()->getStatusCode();
  
      else echo  "No response from server.";
  
      echo "\nException: message = " . $e->getMessage() . "\n";
  
  } catch (\Exception $e) {
      
      echo "\nException: message = " . $e->getMessage() . "\n";
  } 

