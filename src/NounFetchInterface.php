<?php
declare(strict_types=1);
namespace LanguageTools;

use LanguageTools\PonsDictionary;

interface NounFetchInterface  {

    public function get_gender(string $word) : string | null; 
    public function get_plural(string $word) : string | null;
}
