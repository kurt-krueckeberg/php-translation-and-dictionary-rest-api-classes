<?php
declare(strict_types=1);

// Generic rest translation API wrapper for guzzle/http users.
abstract class GuzzleTranslateAPIWarpper {
    
    static public function create_implementor(string $xml_fname, string $service)
    {
       // todo: Add logic to get the SimpleXMLElement pointer (to specific translation sectionn) using an XPath query.
       $simpl = simplexml_load_file($xml_fname);

       // create $query based on $service
       $simpl_ele = $simpl->xpath($query)  
 
       // Create the Derived Translator classes that use Guzzle
       switch($simpl_ele->name) { 

         case 'I':
           $trans = new IbmXXXTranslator($el);
           break;

        case 'M':
           $trans = new MSTranlator($el);
           break;        case 'M':

           $trans = new DeeplTranslate($el);
           break;
       }
       return $trans;
    }

    abstract public function prepare_trans_request(string $text, string $source_lang, string $target_lang);

    abstract public function send_trans_request(); 

    abstract public function get_sentences(); // TODO: Return Generic respons object that implements--what?
}
