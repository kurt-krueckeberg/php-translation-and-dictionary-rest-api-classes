<?php
namespace LanguageTools;

interface DictionaryInterface {
   
   /*
    todo: 
     What is the best retun type;

     Should it return an array whose key is the head word ike this: ["headword here" => ["dfinition 1", "dfinition 2", ...]] ?                   
     Should it return just an array of definitions:  ["headword here" => ["dfinition 1", "dfinition 2", ...]] ?                   
     The Microsoft Azure api returns a one-word defiiniotn, a string.
    */
   public function lookup(string $str, string $src_lang, string $dest_lang) : string |array; 
}
