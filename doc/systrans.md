# Systran PRO - API 

- [Pricing](https://www.systran.net/en/plans-pricing/). See "for Developers API" a bottom of page.

- [Login for Systran Pro: translate.systran.net/user](https://translate.systran.net/user). **note:** Do not sign in at `www.systran.net` (which for reason unknown to md display incorrect and incomplete infomration).

## Systran API Dcoumentation

- [Documentionat Main Page](https://docs.systran.net/translateAPI/)

- [Systrans Translation API](https://docs.systran.net/translateAPI/translation)

- [Dictionary lookup](https://docs.systran.net/translateAPI/dictionary)

- [User Console](https://trs.systran.net/user)

## Dictionary Matches Results

```json
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
      "lemma": "dog",    <--- This is the input word being defined, whose definitions are given in the "targets" below. NOTE: 'lemma' in "targets" is a definition.
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

```

`lookup($word, $src, $target)` response array returned from `lookup("Handeln", "de", "en")`:

foreach($matches as $match) // prospective code:

```php
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
                    [lemma] => Handeln  <-- $match->source->lemma is the word being defined. It's definition is also a 'lemma' property below.
                    [phonetic] =>                                                            
                    [pos] => noun       <-- $match->source->pos = Part Of Speech                                
                    [term] => Handeln   <-- $match->source->term is the 'input' word that was passed to the REST dictionary lookup call; however, 'lemma' above is the word actually being defined in machtes[0].
                )                                                                            
                                                                                             
            [targets] => Array          <-- foreach($match->targets as $target)... 
                (                                                                            
                    [0] => stdClass Object                                                   
                        (                                                                    
                            [context] =>                                                     
                            [domain] =>                                                      
                            [entry_id] => 13951        'expressions' below appear to be shortexample phrases illustrating the word in the 'lemma' property above.                                       
                            [expressions] => Array    <-- if (isset($target->expressions) OR count($target->expressions) !== 0) { 
                                (                             foreach($target->expressions as $expression)... Question: Is the if-test necessary, or will there always be expression. NOTE: These 'expressions' will not necessarily be in this order
                                    [0] => stdClass Object                                                                                                                                   in the output. 
                                        (                                                    
                                            [source] => Handeln der EU    <-- $expression->source is in the expression in the source language.
                                            [target] => action of the eu  <-- $expression->target is its translation.                    
                                        )                                                    
                                                                                             
                                    [1] => stdClass Object                                   
                                        (                                                    
                                            [source] => Handeln der Kommission               
                                            [target] => action of the commission             
                                        )                                                    
                                                                                             
                                )                                                            
                                                                                             
                            [info] =>                                                        
                            [invmeanings] => Array  <--- $target->invmeanings can be ignored                                         
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
                                                                                             
                            [lemma] => action  <-- $target->lemma is the definition for $match->source->lemma. 
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
                    [lemma] => aushandeln                                    <-- $match->source->lemma is the word being defined. It's definition is also a 'lemma' property below.                                                                                   
                    [phonetic] =>                                                                                                                                                                                                                                     
                    [pos] => verb                                            <-- $match->source->pos = Part Of Speech                                                                                                                                                 
                    [term] => Handeln                                        <-- $match->source->term is the 'input' word that was passed to the REST dictionary lookup call; however, 'lemma' above is the word actually being defined in machtes[0].                
                )                                                                                                                                                                                                                                                     
                                                                                                                                                                                                                                                                                      
            [targets] => Array                                               <-- foreach($match->targets as $target)...                                                                                                                                                               
                (                                                                            
                    [0] => stdClass Object                                                   
                        (                                                                    
                            [context] => Abkommen, Fischerei_Abkommen, Kompromiss, Vertrag   
                            [domain] =>                                                      
                            [entry_id] => 40406                                              
                            [expressions] => Array                           <-- $target->expressions...as above                
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

                            [lemma] => to negotiate   <-- $target->lemma as explained above $target->lemma' is the definition.
                            [rank] => 96
                            [synonym] => 
                            [variant] => 
                        )

                    [1] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 40406
                            [expressions] => Array  Comment: $target->expressions may always exist/be set, but may be empty.
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

    [2] => stdClass Object      $matches[2] which is current $match
        (
            [auto_complete] => 
            [model_name] => mono-deen.mod
            [source] => stdClass Object 
                (
                    [inflection] => 
                    [info] => 
                    [lemma] => aus~handeln  <--- as above
                    [phonetic] => 
                    [pos] => verb           <---- as above
                    [term] => Handeln
                )

            [targets] => Array              <--- as above...  
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

                            [lemma] => to negotiate <-- definition?
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
            [other_expressions] => Array  <-- Note 'other_expressions'. This is something other than standard definitions.
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
                    [lemma] => handeln     <--- what is being defined
                    [phonetic] => 
                    [pos] => verb          <-- verb 
                    [term] => Handeln
                )

            [targets] => Array
                (
                    [0] => stdClass Object
                        (
                            [context] => 
                            [domain] => 
                            [entry_id] => 44824
                            [expressions] => Array  <-- Here are 'expressions', instances of, the 'other_expressions'
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

                            [lemma] => to act  <-- definition
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
```
`
