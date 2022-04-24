<?php
declare(strict_types=1);
namespace LanguageTools;

class UniLeipzigConfig implements ConfigInterface {

   private string $endpoint = "http://api.corpora.uni-leipzig.de/ws";

  public function get_endpoint() : string
  {
     return $this->endpoint;
  }

  public function get_authorization() : array | null
  {
      return array("stuff");
  }
}

