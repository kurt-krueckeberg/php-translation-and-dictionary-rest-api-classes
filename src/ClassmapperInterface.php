<?php
declare(strict_types=1);
namespace LanguageTools;

interface ClassmapInterface {
      public function class_name() : string;
      public function get_config_name() : string;
}
