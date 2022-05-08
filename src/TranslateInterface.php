<?php
declare(strict_types=1);
namespace LanguageTools;

interface TranslateInterface {
   // todo: Should this return an \Iterator or \ArrayIterator or 'string | ResitsIterator'?
   public function translate(string $str, string $dest_lang, string $src_lang="") : string;
   public function getTranslationLanguages() : array;
}
