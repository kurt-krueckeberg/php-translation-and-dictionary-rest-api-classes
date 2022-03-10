<?php
interface TranslateInterface {

   public function translate(string $str, string $src, string $target) : string;
}
