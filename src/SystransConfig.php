<?php
declare(strict_types=1);
namespace LanguageTools;

class SystransConfig {
 /*  These yet-to-be-defined readonly properties are assigned (and promoted to class member variables) on the constructor   */
  public function __construct(public readonly string $endpoint = "", 
      public readonly array $header = array()) {}
}
