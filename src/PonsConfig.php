<?php
declare(strict_types=1);
namespace LanguageTools;

class PonsConfig {
  /* 
  These properties are promoted to public readonly class members on the constructor:

  public readonly string $endpoint = "https://api.pons.com";
 
  public readonly array $header = ["X-Secret" => "5cd95065ab2fcd9569fce1b5e9af4eecbd817ccb54badde17d2f9f10fe0bbf2b"];
  */

 public function __construct(public readonly string $endpoint = "https://api.pons.com",
   public readonly array $header = ["X-Secret" => "5cd95065ab2fcd9569fce1b5e9af4eecbd817ccb54badde17d2f9f10fe0bbf2b"]) {}

}
