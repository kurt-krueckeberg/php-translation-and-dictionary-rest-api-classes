<?php
declare(strict_types=1);
namespace LanguageTools;

interface ClassmapperInterface {

    public function class_name() : string;
    public function get_provider() : string;
}
