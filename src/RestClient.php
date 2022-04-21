<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RestClient {

   protected Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   static array $class_map = array(
  ClassID::Leipzig  => ['class' => 'SentenceFetcher',    'config' => 'Leipzigconfig'  ],
  ClassID::Pons     => ['class' => 'PonsDictionary',     'config' => 'Ponsconfig'     ],
  ClassID::Systrans => ['class' => 'SystransTranslator', 'config' => 'Systranconfig'  ],
  ClassID::Azure    => ['class' => 'AzureTranslator',    'config' => 'Azureconfig'    ],
  ClassID::Ibm      => ['class' => 'IbmTranslator',      'config' => 'Ivmconfig'      ],
  ClassID::Yandex   => ['class' => 'YandexTranslator',   'config' => 'Yandexconfig'   ],
  ClassID::Deepl    => ['class' => 'Deeplranslator',     'config' => 'Deeplconfig'    ],
  );

   static public function createRestClient(ClassID $id) : mixed
   {
      $arr = self::class_map[$id]; 

      $refl = new \ReflectionClass($arr['class']); 
      
      return $refl->newInstance(new $arr['config']);
   }

   protected function request(string $method, string $route, array $options) : string
   {
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   }
 
   /*
    * PHP 8.0 feature: automatic member variable assignemnt syntax.
    */
   protected function __construct(Config $c)
   {     
       $this->client = new Client(['base_uri' => $c->get_endpoint()]);
   } 
}
