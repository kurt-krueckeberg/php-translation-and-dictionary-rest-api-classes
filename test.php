<?php
declare(strict_types=1);
use Translators\Translator;
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;

include "vendor/autoload.php";

//include "AzureTranslator.php";

  $trans = Translator::createFromXML("config.xml", "m");

   $a = array("Guten Tag!", "Geten Morgen");      

  try {
   
    $translation = $trans->translate("Hallo");
    echo $translation . "\n";

  } catch (ClientException $e) {
         
      
  }  catch (RequestException $e) {

         $req = $e->getRequest();

         echo "Dumping request:\n";

         var_dump($req);
           
         echo "\nRequestException message = " . $e->getMessage() . "\n";
         
  } catch (\Exception $e) {
      
        $e->getCode();
        
         echo "\nException: message = " . $e->getMessage() . "\n";
  } 

