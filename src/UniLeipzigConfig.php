<?php
declare(strict_types=1);
namespace LanguageTools;

class UniLeipzigConfig {
  /* 
  This property is promoted to a public readonly class members on the constructor:

   public readonly string $endpoint = "http://api.corpora.uni-leipzig.de/ws";
   */

  public function __construct(public readonly string $endpoint = "http://api.corpora.uni-leipzig.de/ws") {}
}

