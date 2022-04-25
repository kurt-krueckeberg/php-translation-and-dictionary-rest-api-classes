<?php
declare(strict_types=1);
namespace LanguageTools;

class AzureConfig implements ConfigInterface {

  private static string $endpoint = "https://api.cognitive.microsofttranslator.com";
  private static array $headers = ["Ocp-Apim-Subscription-Key" => "ef6e5b44c68d438c8d79cae2f8c020ba", "Ocp-Apim-Subscription-Region" => "eastus2"];


  public function get_endpoint() : string
  {
     return self::$endpoint;
  }

  public function get_authorization() : array | null
  {
      return self::$headers;
  }
}
