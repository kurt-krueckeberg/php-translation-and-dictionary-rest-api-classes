<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RestClient {

   protected Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

/* 
Currently Enumerations can't  be used as array keys. So this array won't work:

   static array $class_map = array(
        ClassID::Leipzig  => ['class' => 'SentenceFetcher',    'config' => 'Leipzigconfig'  ],
        ClassID::Pons     => ['class' => 'PonsDictionary',     'config' => 'Ponsconfig'     ],
        ClassID::Systrans => ['class' => 'SystransTranslator', 'config' => 'Systranconfig'  ],
        ClassID::Azure    => ['class' => 'AzureTranslator',    'config' => 'Azureconfig'    ],
        ClassID::Ibm      => ['class' => 'IbmTranslator',      'config' => 'Ivmconfig'      ],
        ClassID::Yandex   => ['class' => 'YandexTranslator',   'config' => 'Yandexconfig'   ],
        ClassID::Deepl    => ['class' => 'Deeplranslator',     'config' => 'Deeplconfig'    ],
  );

And we therfore can't do:

     $arr = self::$class_map[$id]; 
     $refl = new \ReflectionClass($arr['class']); 
    
     return $refl->newInstance(new $arr['config']);
*/

   static public function createRestClient(ClassID $id) : mixed
   {
      $class_name =  $id->class_name();

      $refl = new \ReflectionClass($class_name); 
      
      return $refl->newInstance($id->config_name());
   }

   protected function request(string $method, string $route, array $options) : string
   {
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   }
 
   protected function __construct(string $endpoint)
   {     
       $this->client = new Client(['base_uri' => $endpoint]);
   } 
}
