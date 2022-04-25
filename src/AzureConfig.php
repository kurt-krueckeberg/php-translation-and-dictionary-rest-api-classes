<?php
declare(strict_types=1);
namespace LanguageTools;

class AzureConfig {
  /* 
  These properties are promoted to public readonly class members on the constructor:

  public readonly array $headers;
  public readonly string $endpoint;
   */

  public function __construct(public readonly array $headers = ["Ocp-Apim-Subscription-Key" => "ef6e5b44c68d438c8d79cae2f8c020ba", "Ocp-Apim-Subscription-Region" => "eastus2"],
                              public readonly string $endpoint = "https://api.cognitive.microsofttranslator.com") {}

}
