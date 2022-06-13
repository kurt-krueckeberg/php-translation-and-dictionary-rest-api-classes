<?php
declare(strict_types=1);

namespace LanguageTools;

interface ResultfileInterface {

   public function add_definitions($word, string $src, string $dest);

   public function add_samples(string $word, int $cnt); 
}
