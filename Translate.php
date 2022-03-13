<?php
declare(strict_types=1);

interface Translate {

   public function translate(string $str, string $src, string $target) : string;
}
