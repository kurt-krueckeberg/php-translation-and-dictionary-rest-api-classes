<?php
interface Translate {

   public function translate(string $str, string $src, string $target) : string;
}
