<?php
declare(strict_types=1);
namespace LanguageTools;

class PonsConfig implements ConfigInterface {

  private string $endpoint = "https://api.pons.com";
 
  private array $header = ["X-Secret" => "5cd95065ab2fcd9569fce1b5e9af4eecbd817ccb54badde17d2f9f10fe0bbf2b"];

  public function get_endpoint() : string
  {
     return $this->endpoint;
  }

  public function get_authorization() : array | null
  {
      return $this->header;
  }
}

