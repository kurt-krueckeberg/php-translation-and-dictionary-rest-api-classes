<?php
declare(strict_types=1);
namespace Translators;

interface TranslateInterface {

   /* Currently translate(string $input, string $dest_lang, string source_lang='') only accepts one text input string. Modify it if your needs differ, say,
     to accept an array of strings. */

   public function translate(string $str, string $dest_lang, string $src_lang="");
}
