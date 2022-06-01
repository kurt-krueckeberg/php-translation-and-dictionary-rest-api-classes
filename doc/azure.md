<section>

Azure Translator 3.0 REST Services Documentation
================================================

Important Payment and Subscription Links
----------------------------------------

-   [Azure Portal](https://portal.azure.com/#home)

-   [Pay-as-you-go rates](https://azure.microsoft.com/en-us/offers/ms-azr-0003p/)

-   [Limits, Quotas and Restratins](https://docs.microsoft.com/en-us/azure/azure-resource-manager/management/azure-subscription-service-limits)

-   Howto [Cancel subscription](https://docs.microsoft.com/en-us/azure/cost-management-billing/manage/cancel-azure-subscription)

Documentation Links:
--------------------

-   Translator Documentation [home page](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)
    (which is excellent)

-   [Quick Start Guide](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator?tabs=csharp)

-   Documentation on [github](https://github.com/MicrosoftDocs/azure-docs/blob/main/articles/cognitive-services/Translator/reference/v3-0-translate.md).

### List of Supported Languages

Do this query:

```bash
https://api.cognitive.microsofttranslator.com//Languages?api-version=3.0
```

### Endpoint for All Translator Version 3.0 Requests 

The endpoint for Translator 3.0 requests is:

 -------------------------------------------------------------------
 **Country**     **Endpoint**
 --------------- ---------------------------------------------------
 United States   **https://api.cognitive.microsofttranslator.com**
 --------------- ---------------------------------------------------

The version of Translator we will use will be 3.0, which is specified as a query string parameter. For example, to request tranlation of input
text, we append "/translate" to the endpoint and then supply the version number: `https://api.cognitive.microsofttranslator.com/translate?api-version=3.0`

### The Five Azure Translator 3.0 (REST API) Request Types

Azure Translator 3.0 supports the five types of services. Each uses a different URL "route" that is appened to the endpoint. The REST requests types are listed below.

 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Request Type                                     URL "route"           Method  Description
 ------------------------------------------------ --------------------- ------- --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 [languages][languages-label]                     /languages            GET     Returns the set of languages currently supported by the translation, transliteration, and dictionary methods. This request does not require authentication headers and you do not need a Translator resource to view the supported language set.
                                                                                                                                                             
 [translate][translate-label]                     /translate            POST    Translate specified source language text into the target language text.
                                                                                                                                                             
 [breakSentence][breakSentence-label]             /breaksentence        POST    Returns an array of integers representing the length of sentences in a source text.
                                                                                                                                                             
 [dictionary/lookup][dictionary/lookup-label]     /dictionary/lookup    POST    Returns alternatives for single word translations.
                                                                                                                                                             
 [dictionary/examples][dictionary/examples-label] /dictionary/examples  POST    Returns how a term is used in context.
 ------------------------------------------------ --------------------- ------- --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

[languages-label]: <https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-languages>                     
[translate-label]: <https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-translate>                     
[breakSentence-label]: <https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-break-sentence>            
[dictionary/lookup-label]: <https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-dictionary-lookup>     
[dictionary/examples-label]: <https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-dictionary-examples> 

Since version 3.0 of Translator will always be used, the five request types will begin with these extended URLs:

 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Request Type                                        URL                                                                                 "route"                Endpoint + route + API Version
 --------------------------------------------------- ----------------------------------------------------------------------------------- ---------------------- -------------------------------------------------------------------------------------
 [languages][languages-label]                        <https://api.cognitive.microsofttranslator.com/languages?api-version=3.0>           /languages             <https://api.cognitive.microsofttranslator.com/languages?api-version=3.0>
                                                                                                                                       
 [translate][translate-label]                        <https://api.cognitive.microsofttranslator.com/translate?api-version=3.0>           /translate             <https://api.cognitive.microsofttranslator.com/translate?api-version=3.0>
                                                                                                                                       
 [breakSentence][breakSentence-label]                <https://api.cognitive.microsofttranslator.com/breaksentence?api-version=3.0>       /breaksentence         <https://api.cognitive.microsofttranslator.com/breaksentence?api-version=3.0>
                                                                                                                                       
 [dictionary/lookup][dictionary/lookup-label]        <https://api.cognitive.microsofttranslator.com/dictionary/lookup?api-version=3.0>   /dictionary/lookup     <https://api.cognitive.microsofttranslator.com/dictionary/lookup?api-version=3.0>
                                                                                                                                       
 [dictionary/examples][dictionary/examples-label]    <https://api.cognitive.microsofttranslator.com/dictionary/examples?api-version=3.0> /dictionary/examples   <https://api.cognitive.microsofttranslator.com/dictionary/examples?api-version=3.0>
 --------------------------------------------------- ----------------------------------------------------------------------------------- ---------------------- -------------------------------------------------------------------------------------

Supposedly **api-verions=3.0** must be the first query string parameter.

### Translator 3.0 Required Headers

#### Authorizaion with a regional resource.

  --------------------------------------------------------------------------------------------------------------------------------------------------------------
  Headers                            Description                                                                  My Values
  ---------------------------------- ---------------------------------------------------------------------------- ----------------------------------------------
  **Ocp-Apim-Subscription-Key**      The value is the Azure **secret key** for your subscription to Translator.   See your Azure portal account for your keys.

  **Ocp-Apim-Subscription-Region**   The value is the **region** of the translator resource.                      **eastus2** is an example region.
  ---------------------------------- ---------------------------------------------------------------------------- ----------------------------------------------

#### Header for Content and Length 

+----------------------------------+-----------------------------------------------+
| Headers                          | Description                                   |
+----------------------------------+-----------------------------------------------+
| Content-Type                     | Specifies the content type of                 |
|                                  | the payload.                                  |
|                                  |                                               |
|                                  | Accepted value is                             |
|                                  | `application/json;charset=UTF-8`              |
+----------------------------------+-----------------------------------------------+
| Content-Length (See comments     | The length of the request body.               |
| below)                           | This is NOT Needed for                        |
|                                  | *translation* requests                        |
+----------------------------------+-----------------------------------------------+

The [Get Sentence Length](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator?tabs=csharp#get-sentence-length-during-translation) section of the [Quick Start guide](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator?tabs=csharp)
explains if you set (when requesting **translation?api-version=3.0** ) the query parameter "**includeSentenceLength=true"**, the input and output sentence lengths will be also returned in the response.

#### Optional Headers

  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Headers           Description
  ----------------- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  X-ClientTraceId   A **client-generated GUID** to uniquely identify the request. You can omit this header if you include the trace ID in the query string using a query parameter named ClientTraceId.
  ----------------- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

### Translate Request Body

See [Request Body](https://docs.microsoft.com/en-us/rest/api/cognitiveservices/translator/translator/translate#request-body)

The body of the request is a JSON array. Each array element is a JSON object with a string property named Text, which represents the string to translate. The following limitations apply:

-  The array can have at most 25 elements.

-  The entire text included in the request cannot exceed 5,000 characters (including spaces).

Example input JSON array of two JSON objects:

```json
[ {"Text":"Freitag"}, {"Text":"Montag\} ];
```

#### Translator 3.0 Optional Query Parameters

#### Required Parameters {#required-parameters .list-paragraph}

+-----------------+---------------------------------------------------------------------------------------------------------------------------------------------------------+
| Query parameter | Description                                                                                                                                             |
+-----------------+---------------------------------------------------------------------------------------------------------------------------------------------------------+
| **api-version** | *Required parameter*.\                                                                                                                                  |
|                 | Version of the API requested by the client. Value                                                                                                       |
|                 | must be **3.0**.                                                                                                                                        |
+-----------------+---------------------------------------------------------------------------------------------------------------------------------------------------------+
| **to**          | *Required parameter*.                                                                                                                                   |
|                 |                                                                                                                                                         |
|                 | Specifies the language of the output text. The                                                                                                          |
|                 | target language must be one of the [supported languages](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-languages) |
|                 | included in the translation scope. For example,                                                                                                         |
|                 | use to=de to translate to German.\                                                                                                                      |
|                 | It\'s possible to translate to multiple languages                                                                                                       |
|                 | simultaneously by repeating the parameter in the                                                                                                        |
|                 | query string. For example, use to=de&to=it to                                                                                                           |
|                 | translate to German and Italian.                                                                                                                        |
+-----------------+---------------------------------------------------------------------------------------------------------------------------------------------------------+

#### Optional Parameters {#optional-parameters-1}

These query paramters apply (TODO: double check) to all five Tranaslor requst types above.

+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| Query parameter           | Description                                                                                                                |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| **from**                  | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies the language of the input                                                                                        |
|                           | text. Find which languages are                                                                                             |
|                           | available to translate from by looking                                                                                     |
|                           | up [supported languages](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-languages)    | 
|                           | using the translation scope. If the                                                                                        |
|                           | from parameter is not specified,                                                                                           |
|                           | automatic language detection is applied                                                                                    |
|                           | to determine the source language.                                                                                          |
|                           |                                                                                                                            |
|                           | You must use the from parameter rather                                                                                     |
|                           | than autodetection when using the                                                                                          |
|                           | [dynamic dictionary](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/dynamic-dictionary)              |
|                           | feature.                                                                                                                   |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| **textType**              | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Defines whether the text being                                                                                             |
|                           | translated is plain text or HTML text.                                                                                     |
|                           | Any HTML needs to be a well-formed,                                                                                        |
|                           | complete element. Possible values are:                                                                                     |
|                           | **plain** (default) or **html**.                                                                                           |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| category                  | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | A string specifying the category                                                                                           |
|                           | (domain) of the translation. This                                                                                          |
|                           | parameter is used to get translations                                                                                      |
|                           | from a customized system built with                                                                                        |
|                           | [[Custom                                                                                                                   |
|                           | Translator]{.underline}](https:                                                                                            |
|                           | //docs.microsoft.com/en-us/azure/cognit                                                                                    |
|                           | ive-services/translator/customization).                                                                                    |
|                           | Add the Category ID from your Custom                                                                                       |
|                           | Translator [[project                                                                                                       |
|                           | details]{.underline}](https://docs.                                                                                        |
|                           | microsoft.com/en-us/azure/cognitive-ser                                                                                    |
|                           | vices/translator/custom-translator/how-                                                                                    |
|                           | to-create-project#view-project-details)                                                                                    |
|                           | to this parameter to use your deployed                                                                                     |
|                           | customized system. Default value is:                                                                                       |
|                           | general.                                                                                                                   |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| profanityAction           | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies how profanities should be                                                                                        |
|                           | treated in translations. Possible                                                                                          |
|                           | values are: NoAction (default), Marked                                                                                     |
|                           | or Deleted. To understand ways to treat                                                                                    |
|                           | profanity                                                                                                                  |
|                           | [Profanity handling](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-translate#handle- |
|                           |  profanity).                                                                                                               |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| profanityMarker           | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies how profanities should be                                                                                        |
|                           | marked in translations. Possible values                                                                                    |
|                           | are: Asterisk (default) or Tag. To                                                                                         |
|                           | understand ways to treat profanity, see                                                                                    |
|                           | [Profanity handling](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-translate#handle- |
|                           |  profanity).                                                                                                               |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| includeAlignment          | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies whether to include alignment                                                                                     |
|                           | projection from source text to                                                                                             |
|                           | translated text. Possible values are:                                                                                      |
|                           | true or false (default).                                                                                                   |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| **includeSentenceLength** | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies whether to include sentence                                                                                      |
|                           | boundaries for the input text and the                                                                                      |
|                           | translated text. Possible values are:                                                                                      |
|                           | true or false (default).                                                                                                   |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| suggestedFrom             | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies a fallback language if the                                                                                       |
|                           | language of the input text can\'t be                                                                                       |
|                           | identified. Language autodetection is                                                                                      |
|                           | applied when the from parameter is                                                                                         |
|                           | omitted. If detection fails, the                                                                                           |
|                           | suggestedFrom language will be assumed.                                                                                    |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| fromScript                | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies the script of the input text.                                                                                    |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| toScript                  | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies the script of the translated                                                                                     |
|                           | text.                                                                                                                      |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+
| allowFallback             | *Optional parameter*.                                                                                                      |
|                           |                                                                                                                            |
|                           | Specifies that the service is allowed                                                                                      |
|                           | to fall back to a general system when a                                                                                    |
|                           | custom system does not exist. Possible                                                                                     |
|                           | values are: true (default) or false.\                                                                                      |
|                           | \                                                                                                                          |
|                           | allowFallback=false specifies that the                                                                                     |
|                           | translation should only use systems                                                                                        |
|                           | trained for the category specified by                                                                                      |
|                           | the request. If a translation for                                                                                          |
|                           | language X to language Y requires                                                                                          |
|                           | chaining through a pivot language E,                                                                                       |
|                           | then all the systems in the chain                                                                                          |
|                           | (X-\>E and E-\>Y) will need to be                                                                                          |
|                           | custom and have the same category. If                                                                                      |
|                           | no system is found with the specific                                                                                       |
|                           | category, the request will return a 400                                                                                    |
|                           | status code. allowFallback=true                                                                                            |
|                           | specifies that the service is allowed                                                                                      |
|                           | to fall back to a general system when a                                                                                    |
|                           | custom system does not exist.                                                                                              |
+---------------------------+----------------------------------------------------------------------------------------------------------------------------+

#### Example Response Object

**Input Request Body**

The input is an json array of two json objects:

```json
[ {"text":"Freitag"}, {"text":"Montag"} ];
```

**Response Object**

This is the joson response object:

```json
[ {"translations": [ {"text": "Friday", "to": "en", "sentLen": { "srcSentLen": [7], "transSentLen": [6] } } ] },
  {"translations": [ {"text": "Monday", "to": "en", "sentLen": { "srcSentLen": [6], "transSentLen": [6] } } ] } 
]
```

</section>
