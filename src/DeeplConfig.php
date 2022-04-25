<?php
declare(strict_types=1);
namespace LanguageTools;

class DeeplConfig {
 /*
   These readonly properties are assigned (and promoted to class member variables) on the constructor:

      public readonly string $endpoint = "https://api-free.deepl.com/v2";
      prublic readonly array $header = ["DeepL-Auth-Key" => "7482c761-0429-6c34-766e-fddd88c247f9:fx"];
  */

   public __construct(public readonly string $endpoint = "https://api-free.deepl.com/v2",
                      prublic readonly array $header = ["DeepL-Auth-Key" => "7482c761-0429-6c34-766e-fddd88c247f9:fx"]) {}
            
}

