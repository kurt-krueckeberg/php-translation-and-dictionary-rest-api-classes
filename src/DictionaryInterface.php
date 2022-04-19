<?php
namespace LanguageTools;

interface DictionaryInterface {
    /* 
    Todo: 
     What is the best retun type--ResultsIteratorBase | string | array?
    */
   public function lookup(string $str, string $src_lang, string $dest_lang) : string |array; 
}
