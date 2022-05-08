<?php
namespace LanguageTools;

interface DictionaryInterface {
   
   /* Todo: 
     What is the best retun type? ResultsIteratorBase | string | array  ?

     Microsoft Azure returns a one-word string.
    */
   public function lookup(string $str, string $src_lang, string $dest_lang) : string|array|ResultsIterator; 

   public function getDictionaryLanguages() : array; // todo:: Is getSupportedDictionaries() a beeter method name?
}
