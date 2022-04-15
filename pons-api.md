# PONS Dictinary API

PONS Dictinary API [documentation](https://en.pons.com/p/files/uploads/pons/api/api-documentation.pdf). PONS REST PAI allows 1,000 quereires per month. You can contact them at that prior page if more querires are needed.

> The POD-API is provided to you directly with a free quota of 1000 reference queries per month.

If your needs exceed this:

> If your usage will exceed the free quota above, please contact us directly on u.keppler@pons.de, and we’ll arrange terms and conditions for your license. The standard license fee is 3,- Euros per 1000 requests. 
Other pricing models, such as flat fees, limited access to a subset of dictionaries only etc. are subject to negotiation. Talk to us and together we will find out how you can benefit from PONS.

[documentation](https://bg.pons.com/p/files/uploads/pons/api/api-documentation.pdf)

## PONS Dictionary Queries

|Name|Type|Description|
|----------------------|
|X-Secret|HTTP-Header|The supplied secret|
|q|Request-Parameter|Search term (URL-escaped UTF-8)|
|l|Request-Parameter|Dictionary (i.e. deen,deru) - consult the search url on the result page of a search (on our website).  Note: This does not imply a direction, i.e. 'deen' may yield results in both german->english and english->german directions. To specify a direction, use the in-parameter|
|in|Request-Parameter|[optional] Specify the source language (the language of the search term)|

## Supported Languages

To get of supported PONS bilingual dictinaries:

```bash
wget -O - --no-check-certificate "https://api.pons.com/v1/dictionaries?language"
```

To get of supported bilingual German dictinaries:

```bash
wget -O - --no-check-certificate "https://api.pons.com/v1/dictionaries?language=de"
```

This returns this JSON result of dictionaries for input and output language combinations:

```json
[
  {
    "key": "deel",
    "simple_label": "Griechisch «» Deutsch",
    "directed_label": {
      "elde": "Griechisch » Deutsch",
      "deel": "Deutsch » Griechisch"
    },
    "languages": [ "el", "de" ]
  },
  {
    "key": "deen",
    "simple_label": "Englisch «» Deutsch",
    "directed_label": {
      "ende": "Englisch » Deutsch",
      "deen": "Deutsch » Englisch"
    },
    "languages": [ "en", "de" ]
  },
  {
    "key": "defr",
    "simple_label": "Französisch «» Deutsch",
    "directed_label": {
      "frde": "Französisch » Deutsch",
      "defr": "Deutsch » Französisch"
    },
    "languages": [ "fr", "de" ]
  },
  {
    "key": "dees",
    "simple_label": "Spanisch «» Deutsch",
    "directed_label": {
      "esde": "Spanisch » Deutsch",
      "dees": "Deutsch » Spanisch"
    },
    "languages": [ "es", "de" ]
  },
  {
    "key": "deru",
    "simple_label": "Russisch «» Deutsch",
    "directed_label": {
      "rude": "Russisch » Deutsch",
      "deru": "Deutsch » Russisch"
    },
    "languages": [ "ru", "de" ]
  },
  {
    "key": "depl",
    "simple_label": "Polnisch «» Deutsch",
    "directed_label": {
      "plde": "Polnisch » Deutsch",
      "depl": "Deutsch » Polnisch"
    },
    "languages": [ "pl", "de" ]
  },
  {
    "key": "deit",
    "simple_label": "Italienisch «» Deutsch",
    "directed_label": {
      "itde": "Italienisch » Deutsch",
      "deit": "Deutsch » Italienisch"
    },
    "languages": [ "it", "de" ]
  },
  {
    "key": "dept",
    "simple_label": "Portugiesisch «» Deutsch",
    "directed_label": {
      "ptde": "Portugiesisch » Deutsch",
      "dept": "Deutsch » Portugiesisch"
    },
    "languages": [ "pt", "de" ]
  },
  {
    "key": "detr",
    "simple_label": "Türkisch «» Deutsch",
    "directed_label": {
      "trde": "Türkisch » Deutsch",
      "detr": "Deutsch » Türkisch"
    },
    "languages": [ "tr", "de" ]
  },
  {
    "key": "dela",
    "simple_label": "Deutsch «» Latein",
    "directed_label": {
      "dela": "Deutsch » Latein",
      "lade": "Latein » Deutsch"
    },
    "languages": [ "de", "la" ]
  },
  {
    "key": "desl",
    "simple_label": "Deutsch «» Slowenisch",
    "directed_label": {
      "desl": "Deutsch » Slowenisch",
      "slde": "Slowenisch » Deutsch"
    },
    "languages": [ "de", "sl" ]
  },
  {
    "key": "enes",
    "simple_label": "Spanisch «» Englisch",
    "directed_label": {
      "esen": "Spanisch » Englisch",
      "enes": "Englisch » Spanisch"
    },
    "languages": [ "es", "en" ]
  },
  {
    "key": "enfr",
    "simple_label": "Französisch «» Englisch",
    "directed_label": {
      "fren": "Französisch » Englisch",
      "enfr": "Englisch » Französisch"
    },
    "languages": [ "fr", "en" ]
  },
  {
    "key": "enpl",
    "simple_label": "Polnisch «» Englisch",
    "directed_label": {
      "plen": "Polnisch » Englisch",
      "enpl": "Englisch » Polnisch"
    },
    "languages": [ "pl", "en" ]
  },
  {
    "key": "ensl",
    "simple_label": "Slowenisch «» Englisch",
    "directed_label": {
      "slen": "Slowenisch » Englisch",
      "ensl": "Englisch » Slowenisch"
    },
    "languages": [ "sl", "en" ]
  },
  {
    "key": "espl",
    "simple_label": "Spanisch «» Polnisch",
    "directed_label": {
      "espl": "Spanisch » Polnisch",
      "ples": "Polnisch » Spanisch"
    },
    "languages": [ "es", "pl" ]
  },
  {
    "key": "frpl",
    "simple_label": "Französisch «» Polnisch",
    "directed_label": {
      "frpl": "Französisch » Polnisch",
      "plfr": "Polnisch » Französisch"
    },
    "languages": [ "fr", "pl" ]
  },
  {
    "key": "itpl",
    "simple_label": "Italienisch «» Polnisch",
    "directed_label": {
      "itpl": "Italienisch » Polnisch",
      "plit": "Polnisch » Italienisch"
    },
    "languages": [ "it", "pl" ]
  },
  {
    "key": "plru",
    "simple_label": "Russisch «» Polnisch",
    "directed_label": {
      "rupl": "Russisch » Polnisch",
      "plru": "Polnisch » Russisch"
    },
    "languages": [ "ru", "pl" ]
  },
  {
    "key": "essl",
    "simple_label": "Spanisch «» Slowenisch",
    "directed_label": {
      "essl": "Spanisch » Slowenisch",
      "sles": "Slowenisch » Spanisch"
    },
    "languages": [ "es", "sl" ]
  },
  {
    "key": "frsl",
    "simple_label": "Französisch «» Slowenisch",
    "directed_label": {
      "frsl": "Französisch » Slowenisch",
      "slfr": "Slowenisch » Französisch"
    },
    "languages": [ "fr", "sl" ]
  },
  {
    "key": "itsl",
    "simple_label": "Italienisch «» Slowenisch",
    "directed_label": {
      "itsl": "Italienisch » Slowenisch",
      "slit": "Slowenisch » Italienisch"
    },
    "languages": [ "it", "sl" ]
  },
  {
    "key": "enit",
    "simple_label": "Englisch «» Italienisch",
    "directed_label": {
      "enit": "Englisch » Italienisch",
      "iten": "Italienisch » Englisch"
    },
    "languages": [ "en", "it" ]
  },
  {
    "key": "enpt",
    "simple_label": "Englisch «» Portugiesisch",
    "directed_label": {
      "enpt": "Englisch » Portugiesisch",
      "pten": "Portugiesisch » Englisch"
    },
    "languages": [ "en", "pt" ]
  },
  {
    "key": "enru",
    "simple_label": "Englisch «» Russisch",
    "directed_label": {
      "enru": "Englisch » Russisch",
      "ruen": "Russisch » Englisch"
    },
    "languages": [ "en", "ru" ]
  },
  {
    "key": "espt",
    "simple_label": "Spanisch «» Portugiesisch",
    "directed_label": {
      "espt": "Spanisch » Portugiesisch",
      "ptes": "Portugiesisch » Spanisch"
    },
    "languages": [ "es", "pt" ]
  },
  {
    "key": "esfr",
    "simple_label": "Spanisch «» Französisch",
    "directed_label": {
      "esfr": "Spanisch » Französisch",
      "fres": "Französisch » Spanisch"
    },
    "languages": [ "es", "fr" ]
  },
  {
    "key": "delb",
    "simple_label": "Deutsch «» Elbisch",
    "directed_label": {
      "delb": "Deutsch » Elbisch",
      "lbde": "Elbisch » Deutsch"
    },
    "languages": [ "de", "lb" ]
  },
  {
    "key": "dezh",
    "simple_label": "Deutsch «» Chinesisch",
    "directed_label": {
      "dezh": "Deutsch » Chinesisch",
      "zhde": "Chinesisch » Deutsch"
    },
    "languages": [ "de", "zh" ]
  },
  {
    "key": "enzh",
    "simple_label": "Englisch «» Chinesisch",
    "directed_label": {
      "enzh": "Englisch » Chinesisch",
      "zhen": "Chinesisch » Englisch"
    },
    "languages": [ "en", "zh" ]
  },
  {
    "key": "eszh",
    "simple_label": "Spanisch «» Chinesisch",
    "directed_label": {
      "eszh": "Spanisch » Chinesisch",
      "zhes": "Chinesisch » Spanisch"
    },
    "languages": [ "es", "zh" ]
  },
  {
    "key": "frzh",
    "simple_label": "Französisch «» Chinesisch",
    "directed_label": {
      "frzh": "Französisch » Chinesisch",
      "zhfr": "Chinesisch » Französisch"
    },
    "languages": [ "fr", "zh" ]
  },
  {
    "key": "denl",
    "simple_label": "Deutsch «» Niederländisch",
    "directed_label": {
      "denl": "Deutsch » Niederländisch",
      "nlde": "Niederländisch » Deutsch"
    },
    "languages": [ "de", "nl" ]
  },
  {
    "key": "arde",
    "simple_label": "Arabisch «» Deutsch",
    "directed_label": {
      "arde": "Arabisch » Deutsch",
      "dear": "Deutsch » Arabisch"
    },
    "languages": [ "ar", "de" ]
  },
  {
    "key": "defa",
    "simple_label": "Deutsch «» Persisch",
    "directed_label": {
      "defa": "Deutsch » Persisch",
      "fade": "Persisch » Deutsch"
    },
    "languages": [ "de", "fa" ]
  },
  {
    "key": "defi",
    "simple_label": "Deutsch «» Finnisch",
    "directed_label": {
      "defi": "Deutsch » Finnisch",
      "fide": "Finnisch » Deutsch"
    },
    "languages": [ "de", "fi" ]
  },
  {
    "key": "dehr",
    "simple_label": "Deutsch «» Kroatisch",
    "directed_label": {
      "dehr": "Deutsch » Kroatisch",
      "hrde": "Kroatisch » Deutsch"
    },
    "languages": [ "de", "hr" ]
  },
  {
    "key": "deja",
    "simple_label": "Deutsch «» Japanisch",
    "directed_label": {
      "deja": "Deutsch » Japanisch",
      "jade": "Japanisch » Deutsch"
    },
    "languages": [ "de", "ja" ]
  },
  {
    "key": "dero",
    "simple_label": "Deutsch «» Rumänisch",
    "directed_label": {
      "dero": "Deutsch » Rumänisch",
      "rode": "Rumänisch » Deutsch"
    },
    "languages": [ "de", "ro" ]
  },
  {
    "key": "desk",
    "simple_label": "Deutsch «» Slowakisch",
    "directed_label": {
      "desk": "Deutsch » Slowakisch",
      "skde": "Slowakisch » Deutsch"
    },
    "languages": [ "de", "sk" ]
  },
  {
    "key": "esit",
    "simple_label": "Spanisch «» Italienisch",
    "directed_label": {
      "esit": "Spanisch » Italienisch",
      "ites": "Italienisch » Spanisch"
    },
    "languages": [ "es", "it" ]
  },
  {
    "key": "frit",
    "simple_label": "Französisch «» Italienisch",
    "directed_label": {
      "frit": "Französich » Italienisch",
      "itfr": "Italienisch » Französisch"
    },
    "languages": [ "fr", "it" ]
  },
  {
    "key": "bgde",
    "simple_label": "Bulgarisch «» Deutsch",
    "directed_label": {
      "bgde": "Bulgarisch » Deutsch",
      "debg": "Deutsch » Bulgarisch"
    },
    "languages": [ "bg", "de" ]
  },
  {
    "key": "bgen",
    "simple_label": "Bulgarisch «» Englisch",
    "directed_label": {
      "bgen": "Bulgarisch » Englisch",
      "enbg": "Englisch » Bulgarisch"
    },
    "languages": [ "bg", "en" ]
  },
  {
    "key": "dade",
    "simple_label": "Dänisch «» Deutsch",
    "directed_label": {
      "dade": "Dänisch » Deutsch",
      "deda": "Deutsch » Dänisch"
    },
    "languages": [ "da", "de" ]
  },
  {
    "key": "csde",
    "simple_label": "Tschechisch «» Deutsch",
    "directed_label": {
      "csde": "Tschechisch » Deutsch",
      "decs": "Deutsch » Tschechisch"
    },
    "languages": [ "cs", "de" ]
  },
  {
    "key": "dehu",
    "simple_label": "Deutsch «» Ungarisch",
    "directed_label": {
      "dehu": "Deutsch » Ungarisch",
      "hude": "Ungarisch » Deutsch"
    },
    "languages": [ "de", "hu" ]
  },
  {
    "key": "deno",
    "simple_label": "Deutsch «» Norwegisch",
    "directed_label": {
      "deno": "Deutsch » Norwegisch",
      "node": "Norwegisch » Deutsch"
    },
    "languages": [ "de", "no" ]
  },
  {
    "key": "desv",
    "simple_label": "Deutsch «» Schwedisch",
    "directed_label": {
      "desv": "Deutsch » Schwedisch",
      "svde": "Schwedisch » Deutsch"
    },
    "languages": [ "de", "sv" ]
  },
  {
    "key": "deis",
    "simple_label": "Deutsch «» Isländisch",
    "directed_label": {
      "deis": "Deutsch » Isländisch",
      "isde": "Isländisch » Deutsch"
    },
    "languages": [ "de", "is" ]
  },
  {
    "key": "desr",
    "simple_label": "Deutsch «» Serbisch",
    "directed_label": {
      "desr": "Deutsch » Serbisch",
      "srde": "Serbisch » Deutsch"
    },
    "languages": [ "de", "sr" ]
  },
  {
    "key": "ensr",
    "simple_label": "Englisch «» Serbisch",
    "directed_label": {
      "ensr": "Englisch » Serbisch",
      "sren": "Serbisch » Englisch"
    },
    "languages": [ "en", "sr" ]
  },
  {
    "key": "dede",
    "simple_label": "Rechtschreibung und Fremdwörter",
    "directed_label": {
      "dede": "Rechtschreibung und Fremdwörter"
    },
    "languages": [ "de" ]
  },
  {
    "key": "dedx",
    "simple_label": "Deutsch als Fremdsprache",
    "directed_label": {
      "dedx": "Deutsch als Fremdsprache"
    },
    "languages": [ "de" ]
  },
  {
    "key": "lgsdeen",
    "simple_label": "Deutsch «» Englisch",
    "directed_label": {
      "deen": "Deutsch » Englisch",
      "ende": "Englisch » Deutsch"
    },
    "languages": [ "de", "en" ]
  },
  {
    "key": "lgsdees",
    "simple_label": "Deutsch «» Spanisch",
    "directed_label": {
      "dees": "Deutsch » Spanisch",
      "esde": "Spanisch » Deutsch"
    },
    "languages": [ "de", "es" ]
  },
  {
    "key": "lgsdefr",
    "simple_label": "Deutsch «» Französisch",
    "directed_label": {
      "defr": "Deutsch » Französisch",
      "frde": "Französisch » Deutsch"
    },
    "languages": [ "de", "fr" ]
  },
  {
    "key": "lgsdela",
    "simple_label": "Deutsch «» Französisch",
    "directed_label": {
      "defr": "Deutsch » Französisch",
      "frde": "Französisch » Deutsch"
    },
    "languages": [ "de", "fr" ]
  }
]
```
**Comments:**

If seems that the four-letter dictionary **key** and **simple_label** are composed from the names (in German?) of the input and output langagues?

Question: Are the input and output language two-letter abbreviations the same as those used by deepl, Azure and IBM? That is, is there a standard for the language abbreviations?

The German => English dictionary is: **deen**; i.e. Duetsch to Englisch. 

