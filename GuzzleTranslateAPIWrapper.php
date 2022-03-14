<?php
declare(strict_types=1);

// Generic rest translation API wrapper for guzzle/http users.
abstract class GuzzleTranslateAPIWarpper {

   /*
      See xpath-explained.md   
   */
    static $xpath_part1 = "/sentence_generation/translation_services/service/abbrev[normalize-space() = '";

    static $xpath_part2 = "']/.."; 

    private function get_service(string $xml_fname, string $abbrev)
    {
       $simpl = simplexml_load_file($xml_fname);

       $query = self::$xpath_part1 . $abbrev . self::$xpath_part2;

       $service = $simpl->xpath($query);
 
       return $service[0];
    }

    static public function create_implementor(string $xml_fname, string $abbrev)
    {
       // Create the Derived Translator classes that use Guzzle
       switch($trans_service) { 

         case 'i':
           $trans = new IbmTranslator($service);
           break;

        case 'm':
           $trans = new MSTranlator($service);
           break;      

        case 'd':
           $trans = new DeeplTranslate($service);
           break;
       }

       return $trans;
    }

    abstract public function prepare_trans_request(string $text, string $source_lang, string $target_lang);

    abstract public function send_trans_request(); 

    abstract public function get_sentences(); // TODO: Return Generic respons object that implements--what?
}
