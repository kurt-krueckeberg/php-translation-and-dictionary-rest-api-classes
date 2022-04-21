<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RestClient {

   protected Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']"; 

   static array $class_map = array(
  ClassID::Leipzig  => ['class' => 'SentenceFetcher', 'config' => 'Leipzigconfig'  ],
  ClassID::Pons     => ['class' => 'PonsDictionary',  'config' => 'Ponsconfig'     ],
  ClassID::Systrans => ['class' => '           , 'config' => '                 ],
  ClassID::Azure    => ['class' => '           , 'config' => '                 ],
  ClassID::Ibm      => ['class' => '           , 'config' => '                 ],
  ClassID::Yandex   => ['class' => '           , 'config' => '                 ],
  ClassID::Deepl    => ['class' => '           , 'config' => '                 ],
  );
   /* 
   todo: Put this in a hardcoedc file: 'config.php'
  That will have keys that are of typoe ClasssID and subarrays with a subarray: [ClassID::Zaure  => ['class' => 'AzureTranslator', 'config' => 'Azureconfig']]
    */ 

   /* 
      Instantiate the RestClient-derived class specified in <implementation>...</implementation>
      and pass it the apporpitate \SimpleXmlElement.
    */ 
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
