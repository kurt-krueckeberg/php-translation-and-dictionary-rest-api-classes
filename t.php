<?php
declare(strict_types=1);
namespace LanguageTools;

$class_map = array(
/*
  ClassID::Leipzig->value  => ['class' => 'SentenceFetcher',    'config' => 'Leipzigconfig'  ],
  ClassID::Pons     => ['class' => 'PonsDictionary',     'config' => 'Ponsconfig'     ],
  ClassID::Systrans => ['class' => 'SystransTranslator', 'config' => 'Systranconfig'  ],
  ClassID::Azure    => ['class' => 'AzureTranslator',    'config' => 'Azureconfig'    ],
  ClassID::Ibm      => ['class' => 'IbmTranslator',      'config' => 'Ivmconfig'      ],
  ClassID::Yandex   => ['class' => 'YandexTranslator',   'config' => 'Yandexconfig'   ],
  ClassID::Deepl    => ['class' => 'Deeplranslator',     'config' => 'Deeplconfig'    ],
*/
  );


   function createRestClient(ClassID $id) : mixed
   {
     if (count($class_map) == 0) 
       $class_map[ClassID::Leipzig->value] = 'def';

      print_r( $class_map['class'] ); 
   }
