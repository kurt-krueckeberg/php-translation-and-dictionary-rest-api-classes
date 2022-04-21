<?php
declare(strict_types=1);
namespace LanguageTools;

abstract class Config {

  abstract public function get_endpoint();
  abstract public function get_authorization();  
}
