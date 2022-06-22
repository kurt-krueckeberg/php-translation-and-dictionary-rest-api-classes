<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\PonsDictionary;

interface NounFetchInterface  {

    public function get_noun_info(string $word) : array;
}
