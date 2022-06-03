<?php
namespace LanguageTools;

interface DictionaryInterface {
   
   public function lookup(string $str, string $src_lang, string $dest_lang) : array|ResultsIterator;
   public function getDictionaryLanguages() : array | ResultsIterator; 
}
