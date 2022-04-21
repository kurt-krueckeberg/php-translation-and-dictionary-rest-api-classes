<?php
declare(strict_types=1);
namespace LanguageTools;

class IbmTranslator extends Translator {

   static private array  $trans_route = array('method' => 'POST', 'route' => "?????????????");     
   static private array $lookup__route = array('method' => 'GET', 'route' => "?????????????");     

   static private string $from_key = "????"; 
   static private string $to_key = "????";  

   private $query = array();
   private $headers = array();
    
   public function __construct(\SimpleXMLElelement $provider, string $abbrev) 
   {
      if ($abbrev != RestClient::IBM)
           throw new \Exception("Wrong provider passed");
 
      parent::__construct($provider, Rest::IBM_ABBREV);
   }

   protected function add_text(string $text, array $options)
   {
   }
}
