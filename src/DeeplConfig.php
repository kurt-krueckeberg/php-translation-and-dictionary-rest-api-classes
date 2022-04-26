<?php
declare(strict_types=1);
namespace LanguageTools;

class DeeplConfig {
 /* These readonly properties are promoted to class member properties on the constructor:  */
   public __construct(public readonly string $endpoint = "https://api-free.deepl.com/v2",
                      prublic readonly array $header = ["DeepL-Auth-Key" => "7482c761-0429-6c34-766e-fddd88c247f9:fx"]) {}
            
}
