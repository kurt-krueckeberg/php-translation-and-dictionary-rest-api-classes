# PONS Free 1000-word per Month Dictionary API

- base url:  https://api.pons.com/v1/dictionary

- German-English Dictionary key: "deen"

## Get Parameters

 --------------------------------------------------------------------
 Name      Type               Description
 --------- ------------------ ---------------------------------------
 X-Secret  HTTP-Header        The supplied secret
           
 q         Request-Parameter  Search term (URL-escaped UTF-8)
           
 l         Request-Parameter  Dictionary key. Exaple "deen" is\
                              DE <==> EN
           
 in        Request-Parameter  Source language (optional)
           
 fm        Request-Parameter  fm=1 enables fuzzy matching (optional)
           
 ref       Request-Parameter  ref=true enables references. See below.\
                              (optional\, recommended)

 language  Request-Parameter  **ISO 639-1** target language code:\
                              de, el, en, es, fr, it, pl, pt, ru, sl,\
                              tr, zh 
 --------- ------------------ ---------------------------------------

 TABLE: Get Requests

## My PONS 

### Secret

`5cd95065ab2fcd9569fce1b5e9af4eecbd817ccb54badde17d2f9f10fe0bbf2b`

### Example using curl:

Request translation of German word "Handeln" by specifying:

 ----------------------------------
 Parameter    Meaning
 ------------ ---------------------
 l=deen       Dictionary key is "deen"

 q=Handeln    Translate word "Handel"

 in=de        Source language is German

 language=en  Translate into English

 ref=true     Enable references
 ------------ ---------------------

```bash
curl -v --header "X-Secret: 5cd95065ab2fcd9569fce1b5e9af4eecbd817ccb54badde17d2f9f10fe0bbf2b" "https://api.pons.com/v1/dictionary?l=deen&in=de&q=Handeln&language=en"
```

## Responsess

### Response Codes
  
 -----------------------------------------------------------------------------------
 Code   Message                Explanation/Possible reasons
 ------ ---------------------- -----------------------------------------------------
 200    OK                     Normal condition (results could be found)
 
 204    NO CONTENT             Normal condition (no results could be found)
 
 404    NOT FOUND              The dictionary does not exist
 
 403 NOT AUTHORIZED            The supplied credentials could not be verified, or\
                               access to a dictionary is not allowed
 
 500    INTERNAL SERVER ERROR  An internal error has occurred
 ------ ---------------------- -----------------------------------------------------

### Response Content

If results could be found, there should be objects for each direction. These objects contain

- a key "lang", that defines the source language and therefore the language direction
- a "hits" object "hits", that contains the results for this language direction

### "hits" Response Types

The "hits" object contains suboejcts is of two possible types:

 ----------------------------------------
 Type              Description
 ---------------- -----------------------
 "entry"           Responses with entries

 "translations"    XXXXXXX????
 ---------------- -----------------------

"hits" may contain objects of type "type"="entry" (for cursive items, also see definition below):

```json
hits:
  [
    {
      type: "entry",
      opendict: true/false,
      roms:
      [
      {
            headword: "headword",
            headword_full: "headword_full",
            wordclass: "wordclass (optional)",
            arabs:
            [
            {
                header: "header",
                translations:
                [
                 {
                   source: "source",
                   target: "target"
                  },
                  {
                    [next translation]
                  },
                    [...]
               ]
            },
            {
            next arab
            },
            [...]
            ]
            },
            {
            [next rom]
            },
            API Dict 4
            [...]
            ]
            },
            {
            [next entry]
            },
            [...]
      ]
      Example: https://api.pons.com/v1/dictionary?q=Haus&l=deen

Note:
For formatting the results, you may have a look at the (css) styles used on our website.
Responses with translations
If no entries could be found, we search for translations, so there may be responses that only
contain these:
hits:
[
{
type: "translation",
opendict: true/false,
source,
target
},
{
next translation
},
[...]
]
Example: https://api.pons.com/v1/dictionary?q=to%20care%20for&l=deen
References
Some entries contain references to other entries. If the request-parameter ref=true is
given, these references will be included in the response, too. Referenced entries are then
marked with the type entry_with_secondary_entries. The primary entry is the contained
under the key primary_entry, the references in an array under the key
secondary_entries. All entries are syntactically equal to entries as defined above.
Example: https://api.pons.com/v1/dictionary?q=went&l=deen&ref=true
hits:
[
{
type: "entry_with_secondary_entries",
primary_entry:
{
type: "entry",
API Dict 5
roms:
[
{
headword: "went",
[...]
}
]
},
secondary_entries:
[
{
type: "entry",
roms:
[
{
headword: "go",
[...]
}
]
},
{
next secondary entry
},
[...]
]
}
]
Definitions
Here are some definitions we are using in this context:
Roms
A rom contains a headword and linguistic data related to this headword. The headword is
usually the word you would lookup in a printed dictionary.
headword_full may include additional information, such as phonetics, gender, etc. .
For each part of speech there is one rom (roman numeral). For example "cut" may be a
noun, adjective, interjection, transitive or intransitive verb and has the roms I to V.
Arabs
An arab contains a header (arabic numeral) and stands for a specific meaning of the
headword described in the rom. For example, the "substantive"-rom of "cut" has 12 arabs.
translations
A translation contains a source/target-pair (the actual translations). 


### Formating

For formatting the results, you may have a look at the (css) styles used on our website.
