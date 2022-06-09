<?php
declare(strict_types=1);
namespace LanguageTools;

// SeeDeepl-doc.md 
class iTransTranslator extends RestClient implements TranslateInterface {
   
   static $trans = array('method' = 'POST', 
   public function __construct(ClassID $id)
   {   
      parent::__construct($id);
   }

   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $json = [['dialect' => $src. 'text' => $input], ['dialect' => $dest] ];

       $contents = $this->request(self::$method, ['json' => $json]); 

       $obj = json_decode($contents);

       return $obj->target->text;
   }
}
