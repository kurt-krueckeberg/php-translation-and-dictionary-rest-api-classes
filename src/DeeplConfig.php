<?php
declare(strict_types=1);
namespace LanguageTools;

class DeeplConfig implements ConfigInterface {

      static private string $endpoint = "https://api-free.deepl.com/v2";
           
      static private array $header = ["DeepL-Auth-Key" => "7482c761-0429-6c34-766e-fddd88c247f9:fx"];
           
  public function get_endpoint() : string
  {
      return self::$endpoint;
  }


  public function get_authorization() : array | null
  {
      return self::$header;
  }
}

