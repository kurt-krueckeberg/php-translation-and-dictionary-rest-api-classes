<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\SentenceFetcher;
use LanguageTools\WebpageCreator;
use LanguageTools\RestClient;
use LanguageTools\TranslateInterface;
use LanguageTools\SentenceFetchInterface;
use LanguageTools\PonsDictionary;

include 'vendor/autoload.php';

  try {

    $xml = \simplexml_load_file("config.xml");
  
    $translator = RestClient::createRestClient($xml, RestClient::DEEPL); 
    
    $pons = RestClient::createRestClient($xml, RestClient::PONS); 

    $file =  new File($argv[1]);
    
    $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

    //create_html_output($fetcher, $translator, $file);
    
    $dict = RestClient::createRestClient($xml, "p");
    
    pons_output($dict, $file);

  } catch (Exception $e) {

         echo "Exception: message = " . $e->getMessage() . "\n";
  } 
