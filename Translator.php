<?php
interface Translator {

   public function translate(string $str, string $src, string $target) : string;
}
