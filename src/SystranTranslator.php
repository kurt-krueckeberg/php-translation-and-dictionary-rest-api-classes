<?php
declare(strict_types=1);
namespace LanguageTools;

// Under development
class SystranTranslator extends RestClient implements TranslateInterface, DictionaryInterface {

   static private array  $trans     = array('method' => "POST", 'route' => "translation/text/translate");

   static private array  $dict_languages = array('method' => "GET", 'route' => "resources/dictionary/supportedLanguages");

   static private array  $trans_languages = array('method' => "???", 'route' => "???????????????????????????????????????");

   static private array  $lookup  = array('method' => "GET", 'route' => "resources/dictionary/lookup");

   static private $input = 'input'; 
   static private string $from = "source";
   static private string $to = "target";

   private array $headers = array();
   private array $query = array(); 

   /*
    There can be more than one query 'option' set; ii.e., the 'options' query paramter can occur more than one. 
    I guess that would mean $thi->query['option'] = ['aaa', 'bbb', ... ];
    */
   
   public function __construct(SystranConfig $c = new SystranConfig)
   {
       parent::__construct($c->endpoint);

       $this->headers[array_key_first($c->header)] = $c->header[array_key_first($c->header)];
   }     

   // Called by base Translator::translate method 
   final protected function add_input(string $text)
   {
       $this->query[self::$input] = urlencode($text);  
   }

   public function getTranslationLanguages() : array
   {
      $contents = $this->request(self::$languages['method'], self::$languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      $arr = json_decode($contents, true);
    
      return $arr["translation"]; 
    } 

   final public function getDictionaryLanguages() : array
   {
      $contents = $this->request(self::$dict_languages['method'], self::$dict_languages['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
      return json_decode($contents, true);    
   } 

  // If there is no source language, the source langauge will be auto-detected.
  // The default expected encoding is utf-8. If it is not utf-8, use the 'options' paramter to specify the endocing.
   protected function setLanguages(string $dest_lang, $source_lang="")
   {
      if ($source_lang !== "") 
           $this->query[self::$from] = $source_lang; 

      $this->query[self::$to] = $dest_lang; 
   }

   /*
    *  Systran requires the language codes to be lowercase.
    *  If the language is not utf-8, then you must speciy the encoding using the 'options' parameter.
    */
   final public function translate(string $text, string $dest_lang, $source_lang="") : string 
   {
       $this->setLanguages(strtolower($dest_lang), strtolower($source_lang)); 

       $this->add_input($text);

       $contents = $this->request(self::$trans['method'], self::$trans['route'], ['headers' => $this->headers, 'query' => $this->query]); 

       $obj = json_decode($contents);
/*
https://docs.systran.net/translateAPI/translation/#tag-Translation shows the layout of the translation response object
 */
       return urldecode($obj->outputs[0]->output);
   }


   /*

The laayout of: $obj->outputs[0]->output->matches, where $obj is: 'json_decode($contents)' is given in the documentation at 
https://docs.systran.net/translateAPI/dictionary as:

"matches": [  <-- array of 1 to N elements.
  {
    "auto_complete": false,
    "model_name": "mono-enfr.mod",
    "other_expressions": [
      {
        "context": "",
        "source": "borax dog",
        "target": "borax chez le chien"
      },
      {
        "context": "",
        "source": "lucky dog",
        "target": "veinard"
      },
      {
        "context": "",
        "source": "sea dog",
        "target": "loup de mer"
      },
      {
        "context": "",
        "source": "top dog",
        "target": "grand chef"
      }
    ],
    "source": {    <-- This is not an array
      "inflection": "(pl:dogs)",
      "info": "",
      "lemma": "dog",
      "phonetic": "[dɑɡ]",
      "pos": "noun",
      "term": "dog"
    },
    "targets": [ <-- sub array of 1 to N elements
      {
        "context": "",
        "domain": "",
        "entry_id": 4987,
        "expressions": [
          {
            "source": "small dog",
            "target": "petit chien"
          },
          {
            "source": "treated dogs",
            "target": "chien traité"
          },
          {
            "source": "large dog",
            "target": "grand chien"
          },
          {
            "source": "male dog",
            "target": "chien mâle"
          }
        ],
        "info": "",
        "invmeanings": [
          "dog"
        ],
        "lemma": "chien",
        "rank": "95",
        "synonym": "",
        "variant": ""
      },
      {
        "context": "",
        "domain": "",
        "entry_id": 4987,
        "expressions": [],
        "info": "",
        "invmeanings": [
          "bitch",
          "dog",
          "slut"
        ],
        "lemma": "chienne",
        "rank": "1",
        "synonym": "",
        "variant": ""
      }
    ]
  }
]

`matches` response array returned for `lookup("Handeln", "de", "en")`:

Array
(
    [0] => stdClass Object
        (
            [auto_complete] => 
            [model_name] => mono-deen.mod
            [source] => stdClass Object
                (
                    [inflection] => 
                    [info] => 
                    [lemma] => Handeln
                    [phonetic] => 
                    [pos] => noun
                    [term] => Handeln
                )

            [targets] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 13951
                            [expressions] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [source] => Handeln der EU
                                            [target] => action of the eu
                                        )

                                    [1] => stdClass Object
                                        (
                                            [source] => Handeln der Kommission
                                            [target] => action of the commission
                                        )

                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => Maßnahme
                                    [1] => Aktion
                                    [2] => Vorgehen
                                    [3] => Tat
                                    [4] => Klage
                                    [5] => Handlung
                                    [6] => Schritt
                                    [7] => Aktivität
                                    [8] => Tätigkeit
                                )

                            [lemma] => action
                            [rank] => 100
                            [synonym] => 
                            [variant] => 
                        )

                )

        )

    [1] => stdClass Object
        (
            [auto_complete] => 
            [model_name] => mono-deen.mod
            [source] => stdClass Object
                (
                    [inflection] => (aushandelt/aushandelte/ausgehandelt)
                    [info] => 
                    [lemma] => aushandeln
                    [phonetic] => 
                    [pos] => verb
                    [term] => Handeln
                )

            [targets] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => Abkommen, Fischerei_Abkommen, Kompromiss, Vertrag
                            [domain] => 
                            [entry_id] => 40406
                            [expressions] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [source] => mit dem rat ausgehandelt
                                            [target] => negotiated with the council
                                        )

                                    [1] => stdClass Object
                                        (
                                            [source] => Kompromiss aushandeln
                                            [target] => to negotiate compromises
                                        )

                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => verhandeln
                                    [1] => aus~handeln
                                )

                            [lemma] => to negotiate
                            [rank] => 96
                            [synonym] => 
                            [variant] => 
                        )

                    [1] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 40406
                            [expressions] => Array
                                (
                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => vermitteln
                                    [1] => herbeiführen
                                    [2] => einfädeln
                                )

                            [lemma] => to broker
                            [rank] => 2
                            [synonym] => 
                            [variant] => 
                        )

                    [2] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 40406
                            [expressions] => Array
                                (
                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => ausarbeiten
                                    [1] => erarbeiten
                                    [2] => herausfinden
                                    [3] => trainieren
                                    [4] => herausarbeiten
                                    [5] => funktionieren
                                    [6] => klappen
                                    [7] => draussen arbeiten
                                )

                            [lemma] => to work out
                            [rank] => 1
                            [synonym] => 
                            [variant] => 
                        )

                )

        )

    [2] => stdClass Object
        (
            [auto_complete] => 
            [model_name] => mono-deen.mod
            [source] => stdClass Object
                (
                    [inflection] => 
                    [info] => 
                    [lemma] => aus~handeln
                    [phonetic] => 
                    [pos] => verb
                    [term] => Handeln
                )

            [targets] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => Abkommen
                            [domain] => 
                            [entry_id] => 40556
                            [expressions] => Array
                                (
                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => verhandeln
                                    [1] => aushandeln
                                )

                            [lemma] => to negotiate
                            [rank] => 100
                            [synonym] => 
                            [variant] => 
                        )

                )

        )

    [3] => stdClass Object
        (
            [auto_complete] => 
            [model_name] => mono-deen.mod
            [other_expressions] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => 
                            [source] => entschlossen handeln
                            [target] => to take decisive action
                        )

                    [1] => stdClass Object
                        (
                            [context] => 
                            [source] => richtig handeln
                            [target] => to do well
                        )

                    [2] => stdClass Object
                        (
                            [context] => 
                            [source] => sofort handeln
                            [target] => to take action straight away
                        )

                    [3] => stdClass Object
                        (
                            [context] => 
                            [source] => endlich handeln
                            [target] => to finally take action
                        )

                )

            [source] => stdClass Object
                (
                    [inflection] => (handelt/handelte/gehandelt)
                    [info] => 
                    [lemma] => handeln
                    [phonetic] => 
                    [pos] => verb
                    [term] => Handeln
                )

            [targets] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44824
                            [expressions] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [source] => gemeinsam handeln
                                            [target] => to act together
                                        )

                                    [1] => stdClass Object
                                        (
                                            [source] => jetzt handeln
                                            [target] => to act now
                                        )

                                    [2] => stdClass Object
                                        (
                                            [source] => schnell handeln
                                            [target] => to act quickly
                                        )

                                    [3] => stdClass Object
                                        (
                                            [source] => entsprechend handeln
                                            [target] => to act accordingly
                                        )

                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => agieren
                                    [1] => fungieren
                                    [2] => wirken
                                    [3] => auftreten
                                    [4] => reagieren
                                    [5] => vorgehen
                                    [6] => sich verhalten
                                    [7] => dienen
                                )

                            [lemma] => to act
                            [rank] => 87
                            [synonym] => 
                            [variant] => 
                        )

                    [1] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44824
                            [expressions] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [source] => international gehandelt
                                            [target] => traded internationally
                                        )

                                    [1] => stdClass Object
                                        (
                                            [source] => weltweit gehandelt
                                            [target] => traded worldwide
                                        )

                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => austauschen
                                    [1] => Handel treiben
                                    [2] => tauschen
                                    [3] => vermarkten
                                    [4] => betreiben Handel
                                )

                            [lemma] => to trade
                            [rank] => 4
                            [synonym] => 
                            [variant] => 
                        )

                    [2] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44824
                            [expressions] => Array
                                (
                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => 
                                )

                            [lemma] => to take action
                            [rank] => 4
                            [synonym] => 
                            [variant] => 
                        )

                    [3] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44824
                            [expressions] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [source] => unter normalen marktwirtschaftlichen Bedingungen handeln
                                            [target] => to operate under normal market-economy conditions
                                        )

                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => funktionieren
                                    [1] => betreiben
                                    [2] => arbeiten
                                    [3] => operieren
                                    [4] => agieren
                                    [5] => bedienen
                                    [6] => wirken
                                    [7] => fungieren
                                )

                            [lemma] => to operate
                            [rank] => 2
                            [synonym] => 
                            [variant] => 
                        )

                )

        )

    [4] => stdClass Object
        (
            [auto_complete] => 
            [model_name] => mono-deen.mod
            [other_expressions] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => 
                            [source] => um staatliche Beihilfen sich handeln
                            [target] => to constitute state aid
                        )

                )

            [source] => stdClass Object
                (
                    [inflection] => (handelt/handelte/gehandelt)
                    [info] => 
                    [lemma] => sich handeln
                    [phonetic] => 
                    [pos] => verb
                    [term] => Handeln
                )

            [targets] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44825
                            [expressions] => Array
                                (
                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => sich beziehen
                                    [1] => betreffen
                                    [2] => verbinden
                                    [3] => zusammenhängen
                                    [4] => beziehen
                                    [5] => im Zusammenhang stehen
                                    [6] => sich erstrecken
                                    [7] => se befassen
                                )

                            [lemma] => to relate
                            [rank] => 0
                            [synonym] => 
                            [variant] => 
                        )

                    [1] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44825
                            [expressions] => Array
                                (
                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => sich belaufen
                                    [1] => betragen
                                    [2] => ausmachen
                                    [3] => hinaus~laufen
                                    [4] => hinauslaufen
                                    [5] => belaufen
                                    [6] => aus~machen
                                )

                            [lemma] => to amount
                            [rank] => 0
                            [synonym] => 
                            [variant] => 
                        )

                    [2] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44825
                            [expressions] => Array
                                (
                                )

                            [info] => 
                            [invmeanings] => Array
                                (
                                    [0] => umfassen
                                    [1] => bestehen
                                    [2] => bestehen aus
                                    [3] => sich erstrecken
                                    [4] => zielen
                                )

                            [lemma] => to consist of
                            [rank] => 0
                            [synonym] => 
                            [variant] => 
                        )

                )

        )

)

*/


    */
   final public function lookup(string $word, string $src_lang, string $dest_lang) : string 
   {      
      $this->setLanguages(strtolower($dest_lang), strtolower($src_lang)); 
       
      $this->add_input($word);
    
      $contents = $this->request(self::$lookup['method'], self::$lookup['route'], ['headers' => $this->headers, 'query' => $this->query]);

      $obj = json_decode($contents); 
      //var_dump($obj);
      
      echo "\n=================\n";
          
      $matches = $obj->outputs[0]->output->matches;
      print_r($matches);
      
      
      //todo: Add this later: $this->process_definitions($output->matches)
          
      return "test";
    }
    
    private function process_definitions(object $matches) // todo: Define return value later.
    {
       foreach($output->matches as $match) {
          
           print_r($match);
          
           echo "\n------------------\n";
       }  
       return "test";   
    }
}
