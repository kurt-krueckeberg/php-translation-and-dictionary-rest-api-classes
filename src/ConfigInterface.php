<?php
declare(strict_types=1);
namespace LanguageTools;

interface ConfigInterface {

  public function get_endpoint() : string;
  public function get_authorization() : array | null ;  
}