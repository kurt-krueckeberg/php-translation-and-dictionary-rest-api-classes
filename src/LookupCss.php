<?php
declare(strict_types=1);
namespace LanguageTools;

class LookupCss {

static private string $css; 

 static public function get_css() : string
 {
    return self::$css;
 }
}
