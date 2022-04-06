<section>

## Tranlation Service Info

### Azure Translation

#### Doc Links

[What is Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/translator-overview)

[Translator 3.0: Translate](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-translate)

#### Implementations in PHP

- Microsoft's [owm implmentation in PHP](https://github.com/MicrosoftTranslator/Text-Translation-API-V3-PHP/blob/master/Translate.php)
- [Matthisan Noback's code](https://github.com/matthiasnoback/microsoft-translator)
    - Mainly just the file [Tranlate.php](https://github.com/matthiasnoback/microsoft-translator/blob/master/src/MatthiasNoback/MicrosoftTranslator/ApiCall/Translate.php)

- [CURL Implementation](https://www.aw6.de/azure/)

- Gernealize the implementation thru interfaces and design patterns like
- Decide on a namespace ????/sentence-generate: 

### DEEPL Translation Service

There is a quota for the free version.

Deepl API Documentation [online](https://www.deepl.com/docs-api).

#### DEEPL Translation Request Parameters

Online documentation of Deepl [Request Parameters](https://www.deepl.com/docs-api/translating-text/request/).

+-----------------+--------------+-------------------------------------------------+
| Parameter       | Optional     | Description                                     |
|                 |              |                                                 |
+==================+==============+================================================+
| text            | Required     | Text to be translated. Only UTF8-encoded plain  |
|                 |              | text is supported. The parameter may be         |
|                 |              | specified multiple times and translations are   |
|                 |              | returned in the same order as they are          |
|                 |              | requested. Each of the parameter values may     |
|                 |              | contain multiple sentences. Up to 50 texts can  |
|                 |              | be sent for translation in one request.         |
+-----------------+--------------+-------------------------------------------------+
| source\_lang    | Optional     | Language of the text to be translated. Options  |     
|                 |              | currently available:                            |
|                 |              |                                                 |
|                 |              | -   \"BG\" - Bulgarian                          |
|                 |              |                                                 |
|                 |              | -   \"CS\" - Czech                              |
|                 |              |                                                 |
|                 |              | -   \"DA\" - Danish                             |
|                 |              |                                                 |
|                 |              | -   \"DE\" - German                             |
|                 |              |                                                 |
|                 |              | -   \"EL\" - Greek                              |
|                 |              |                                                 |
|                 |              | -   \"EN\" - English                            |
|                 |              |                                                 |
|                 |              | -   \"ES\" - Spanish                            |
|                 |              |                                                 |
|                 |              | -   \"ET\" - Estonian                           |
|                 |              |                                                 |
|                 |              | -   \"FI\" - Finnish                            |
|                 |              |                                                 |
|                 |              | -   \"FR\" - French                             |
|                 |              |                                                 |
|                 |              | -   \"HU\" - Hungarian                          |
|                 |              |                                                 |
|                 |              | -   \"IT\" - Italian                            |
|                 |              |                                                 |
|                 |              | -   \"JA\" - Japanese                           |
|                 |              |                                                 |
|                 |              | -   \"LT\" - Lithuanian                         |
|                 |              |                                                 |
|                 |              | -   \"LV\" - Latvian                            |
|                 |              |                                                 |
|                 |              | -   \"NL\" - Dutch                              |
|                 |              |                                                 |
|                 |              | -   \"PL\" - Polish                             |
|                 |              |                                                 |
|                 |              | -   \"PT\" - Portuguese (all Portuguese         |
|                 |              |     varieties mixed)                            |
|                 |              |                                                 |
|                 |              | -   \"RO\" - Romanian                           |
|                 |              |                                                 |
|                 |              | -   \"RU\" - Russian                            |
|                 |              |                                                 |
|                 |              | -   \"SK\" - Slovak                             |
|                 |              |                                                 |
|                 |              | -   \"SL\" - Slovenian                          |
|                 |              |                                                 |
|                 |              | -   \"SV\" - Swedish                            |
|                 |              |                                                 |
|                 |              | -   \"ZH\" - Chinese                            |
|                 |              |                                                 |
|                 |              | If this parameter is omitted, the API will      |
|                 |              | attempt to detect the language of the text and  |
|                 |              | translate it.                                   |
+-----------------+--------------+-------------------------------------------------+
| target\_lang    | Required     | The language into which the text should be      |     
|                 |              | translated. Options currently available:        |
|                 |              |                                                 |
|                 |              | -   \"BG\" - Bulgarian                          |
|                 |              |                                                 |
|                 |              | -   \"CS\" - Czech                              |
|                 |              |                                                 |
|                 |              | -   \"DA\" - Danish                             |
|                 |              |                                                 |
|                 |              | -   \"DE\" - German                             |
|                 |              |                                                 |
|                 |              | -   \"EL\" - Greek                              |
|                 |              |                                                 |
|                 |              | -   \"EN-GB\" - English (British)               |
|                 |              |                                                 |
|                 |              | -   \"EN-US\" - English (American)              |
|                 |              |                                                 |
|                 |              | -   \"EN\" - English (unspecified variant for   |
|                 |              |     backward compatibility; please select EN-GB |
|                 |              |     or EN-US instead)                           |
|                 |              |                                                 |
|                 |              | -   \"ES\" - Spanish                            |
|                 |              |                                                 |
|                 |              | -   \"ET\" - Estonian                           |
|                 |              |                                                 |
|                 |              | -   \"FI\" - Finnish                            |
|                 |              |                                                 |
|                 |              | -   \"FR\" - French                             |
|                 |              |                                                 |
|                 |              | -   \"HU\" - Hungarian                          |
|                 |              |                                                 |
|                 |              | -   \"IT\" - Italian                            |
|                 |              |                                                 |
|                 |              | -   \"JA\" - Japanese                           |
|                 |              |                                                 |
|                 |              | -   \"LT\" - Lithuanian                         |
|                 |              |                                                 |
|                 |              | -   \"LV\" - Latvian                            |
|                 |              |                                                 |
|                 |              | -   \"NL\" - Dutch                              |
|                 |              |                                                 |
|                 |              | -   \"PL\" - Polish                             |
|                 |              |                                                 |
|                 |              | -   \"PT-PT\" - Portuguese (all Portuguese      |
|                 |              |     varieties excluding Brazilian Portuguese)   |
|                 |              |                                                 |
|                 |              | -   \"PT-BR\" - Portuguese (Brazilian)          |
|                 |              |                                                 |
|                 |              | -   \"PT\" - Portuguese (unspecified variant    |
|                 |              |     for backward compatibility; please select   |
|                 |              |     PT-PT or PT-BR instead)                     |
|                 |              |                                                 |
|                 |              | -   \"RO\" - Romanian                           |
|                 |              |                                                 |
|                 |              | -   \"RU\" - Russian                            |
|                 |              |                                                 |
|                 |              | -   \"SK\" - Slovak                             |
|                 |              |                                                 |
|                 |              | -   \"SL\" - Slovenian                          |
|                 |              |                                                 |
|                 |              | -   \"SV\" - Swedish                            |
|                 |              |                                                 |
|                 |              | -   \"ZH\" - Chinese                            |
+-----------------+--------------+-------------------------------------------------+
| split\_sentences| Optional     | Sets whether the translation engine should      |         
|                 |              | first split the input into sentences. This is   |
|                 |              | enabled by default. Possible values are:        |
|                 |              |                                                 |
|                 |              | -   \"0\" - no splitting at all, whole input is |
|                 |              |     treated as one sentence                     |
|                 |              |                                                 |
|                 |              | -   \"1\" (default) - splits on punctuation and |
|                 |              |     on newlines                                 |
|                 |              |                                                 |
|                 |              | -   \"nonewlines\" - splits on punctuation      |
|                 |              |     only, ignoring newlines                     |
|                 |              |                                                 |
|                 |              | For applications that send one sentence per     |
|                 |              | text parameter, it is advisable to set          |
|                 |              | split\_sentences=0, in order to prevent the     |
|                 |              | engine from splitting the sentence              |
|                 |              | unintentionally.                                |
+-----------------+--------------+-------------------------------------------------+
| preserve\_format| Optional     | Sets whether the translation engine should      |ting         
|                 |              | respect the original formatting, even if it     |
|                 |              | would usually correct some aspects. Possible    |
|                 |              | values are:                                     |
|                 |              |                                                 |
|                 |              | -   \"0\" (default)                             |
|                 |              |                                                 |
|                 |              | -   \"1\"                                       |
|                 |              |                                                 |
|                 |              | The formatting aspects affected by this setting |
|                 |              | include:                                        |
|                 |              |                                                 |
|                 |              | -   Punctuation at the beginning and end of the |
|                 |              |     sentence                                    |
|                 |              |                                                 |
|                 |              | -   Upper/lower case at the beginning of the    |
|                 |              |     sentence                                    |
+-----------------+--------------+-------------------------------------------------+
| formality       | Optional     | Sets whether the translated text should lean    |  
|                 |              | towards formal or informal language. This       |
|                 |              | feature currently only works for target         |
|                 |              | languages **\"DE\" (German), \"FR\" (French),   |
|                 |              | \"IT\" (Italian), \"ES\" (Spanish), \"NL\"      |
|                 |              | (Dutch), \"PL\" (Polish), \"PT-PT\", \"PT-BR\"  |
|                 |              | (Portuguese) and \"RU\" (Russian)**.Possible    |
|                 |              | options are:                                    |
|                 |              |                                                 |
|                 |              | -   \"default\" (default)                       |
|                 |              |                                                 |
|                 |              | -   \"more\" - for a more formal language       |
|                 |              |                                                 |
|                 |              | -   \"less\" - for a more informal language     |
+-----------------+--------------+-------------------------------------------------+
| glossary\_id    | optional     | specify the glossary to use for the             |
|                 |              | translation. **important:** this requires the   |
|                 |              | source\_lang parameter to be set and the        |
|                 |              | language pair of the glossary has to match the  |
|                 |              | language pair of the request.                   |
+-----------------+--------------+-------------------------------------------------+

#### Extended Parameters

The following extended parameters are also available. Please refer to
the \"Handling XML\" section below for further information on how to use
these parameters.
                            
+----------------------+--------------+-------------------------------------------------+
| Parameter            | Optional     | Description                                     |
|                      |                                                                |
+======================+==============+=================================================+
| tag\_handling        | Optional     | Sets which kind of tags should be handled.      |
|                      |              | Options currently available:                    |
|                      |              | -   \"xml\"                                     |
|                      |              |                                                 |
|                      |              
+----------------------+--------------+-------------------------------------------------+
| non\_splitting\_tags | Optional     | Comma-separated list of XML tags which never    |
|                      |              | split sentences.                                |
|                      |              |                                                 |
+----------------------+--------------+-------------------------------------------------+
| outline\_detection   | Optional     | Please see the \"Handling XML\" section for     |
|                      |              | further details.                                |
|                      |              |                                                 |
+----------------------+--------------+-------------------------------------------------+
| splitting\_tags      | Optional     | Comma-separated list of XML tags which always   |
|                      |              | cause splits.                                   |
|                      |              |                                                 |
+----------------------+--------------+-------------------------------------------------+
| ignore\_tags         | Optional     | Comma-separated list of XML tags that indicate  |
|                      |              | text not to be translated.                      |
+----------------------+--------------+-------------------------------------------------+

#### Implmentations in PHP 

This github repository uses PHP and Guzzle: [Deepl-Client](https://github.com/tinyappsde/deepl-client)

### IBM Cognitive Services Translation Servoce

</section>
