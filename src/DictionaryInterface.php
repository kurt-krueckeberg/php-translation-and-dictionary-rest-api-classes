<?php
namespace LanguageTools;

interface DictionaryInterface {
   
   /*
    todo: 
     What is the best retun type;

     Try to return: ResultsIteratorBase | string | array

     The Microsoft Azure api returns a one-word defiiniotn, a string.
    */
   public function lookup(string $str, string $src_lang, string $dest_lang) : string |array|ResultsIterator; 

   public function getDictionaryLanguages();
}
