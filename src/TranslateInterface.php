<?php
declare(strict_types=1);
namespace Translators;

interface TranslateInterface {

   public function translate(string $str, string $dest_lang, string $src_lang="");
}
