<?php
declare(strict_types=1);
namespace Translators;

interface DictionaryInterface {

   public function lookup(string $str, string $dest_lang, string $src_lang="");
   public function get_examples(string $str, string $dest_lang, string $src_lang="");
}
