1.  Azure Translator 3.0 REST Services Documentation
    ================================================

    1.  Important Payment and Subscription Links
        ----------------------------------------

-   [[Azure Portal]{.underline}](https://portal.azure.com/#home)

-   [[Pay-as-you-go
    rates]{.underline}](https://azure.microsoft.com/en-us/offers/ms-azr-0003p/)

-   [[Limits, Quotas and
    Restratins]{.underline}](https://docs.microsoft.com/en-us/azure/azure-resource-manager/management/azure-subscription-service-limits)

-   Howto [[Cancel
    subscription]{.underline}](https://docs.microsoft.com/en-us/azure/cost-management-billing/manage/cancel-azure-subscription)

    1.  Documentation Links:
        --------------------

```{=html}
<!-- -->
```
-   Translator Documentation [[home
    page]{.underline}](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)
    (which is excellent)

-   [[Quick Start
    Guide]{.underline}](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator?tabs=csharp)

-   Documentation on
    [[github]{.underline}](https://github.com/MicrosoftDocs/azure-docs/blob/main/articles/cognitive-services/Translator/reference/v3-0-translate.md).

    1.  Translator Summary
        ------------------

        1.  ### List of Supported Languages

Do this query:

https://api.cognitive.microsofttranslator.com//Languages?api-version=3.0

### Endpoint for All Translator Version 3.0 Requests 

The endpoint or base URL for a Translator 3.0 request is:

  --------------- ---------------------------------------------------
  **Country**     **Endpoint**
  United States   **https://api.cognitive.microsofttranslator.com**
  --------------- ---------------------------------------------------

The version of Translator we will use will be 3.0, which is specified as
a query string parameter. For example, to request tranlation of input
text, we append "/translate" to the endpoint and then supply the version
number:

**https://api.cognitive.microsofttranslator.com/translate?api-version=3.0**

### The Five Azure Translator 3.0 (REST API) Request Types

Azure Translator 3.0 supports the five types of services. Each uses a
different URL "route" that is appened to the endpoint. The REST requests
types are listed below.

  -------------------------------------------------------------------------------------------------------------------------------------------------- -------------------------- ---------- --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Request Type                                                                                                                                       URL "route"                Method     Description
  [**[languages]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-languages)                       **/languages**             **GET**    Returns the set of languages currently supported by the **translation**, **transliteration**, and **dictionary** methods. This request does not require authentication headers and you do not need a Translator resource to view the supported language set.
  [**[translate]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-translate)                       **/translate**             **POST**   Translate specified source language text into the target language text.
  [**[breakSentence]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-break-sentence)              **/breaksentence**         **POST**   Returns an array of integers representing the length of sentences in a source text.
  [**[dictionary/lookup]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-dictionary-lookup)       **/dictionary/lookup**     **POST**   Returns alternatives for single word translations.
  [**[dictionary/examples]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-dictionary-examples)   **/dictionary/examples**   **POST**   Returns how a term is used in context.
  -------------------------------------------------------------------------------------------------------------------------------------------------- -------------------------- ---------- --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Since version 3.0 of Translator will always be used, the five request
types will begin with these extended URLs:

  -------------------------------------------------------------------------------------------------------------------------------------------------- -------------------------- ---------------------------------------------------------------------------------------
  Request Type                                                                                                                                       URL "route"                **Endpoint + route + API Version**
  [**[languages]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-languages)                       **/languages**             **https://api.cognitive.microsofttranslator.com/languages?api-version=3.0**
  [**[translate]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-translate)                       **/translate**             **https://api.cognitive.microsofttranslator.com/translate?api-version=3.0**
  [**[breakSentence]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-break-sentence)              **/breaksentence**         **https://api.cognitive.microsofttranslator.com/breaksentence?api-version=3.0**
  [**[dictionary/lookup]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-dictionary-lookup)       **/dictionary/lookup**     **https://api.cognitive.microsofttranslator.com/dictionary/lookup?api-version=3.0**
  [**[dictionary/examples]{.underline}**](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-dictionary-examples)   **/dictionary/examples**   **https://api.cognitive.microsofttranslator.com/dictionary/examples?api-version=3.0**
  -------------------------------------------------------------------------------------------------------------------------------------------------- -------------------------- ---------------------------------------------------------------------------------------

**[Important]{.underline}**: **api-verions=3.0** must be the first query
string parameter.

### Translator 3.0 Translate Requests

Translate REST API
[[documentation]{.underline}](https://docs.microsoft.com/en-us/rest/api/cognitiveservices/translator/translator/translate#request-body).

#### Endpoint and Route {#endpoint-and-route .list-paragraph}

**https://api.cognitive.microsofttranslator.com/translate?api-version=3.0**

Endpoint is in blue and route is in read.

#### Translator 3.0 Required Headers {#translator-3.0-required-headers .list-paragraph}

#### Autehtication Headers {#autehtication-headers .list-paragraph}

Azure Translator supports [[several methods of
authentication]{.underline}](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/reference/v3-0-reference)
including authentication with a regional resource (which does not
require the a header with "Authorization" to be sent). The table below
shows

authorizaion with a regional resource.

  ---------------------------------- ---------------------------------------------------------------------------- ----------------------------------------------
  Headers                            Description                                                                  My Values
  **Ocp-Apim-Subscription-Key**      The value is the Azure **secret key** for your subscription to Translator.   See your Azure portal account for your keys.
  **Ocp-Apim-Subscription-Region**   The value is the **region** of the translator resource.                      **eastus2** is an example region.
  ---------------------------------- ---------------------------------------------------------------------------- ----------------------------------------------

#### Header for Content and Length {#header-for-content-and-length .list-paragraph}

+----------------------------------+----------------------------------+
| Headers                          | Description                      |
+----------------------------------+----------------------------------+
| Content-Type                     | Specifies the content type of    |
|                                  | the payload.                     |
|                                  |                                  |
|                                  | Accepted value is                |
|                                  | **                               |
|                                  | application/json;charset=UTF-8** |
+----------------------------------+----------------------------------+
| Content-Length (See comments     | The length of the request body.  |
| below)                           | This is NOT Needed for           |
|                                  | *translation* requests           |
+----------------------------------+----------------------------------+

Comments:

I believe **json** is the [default setting]{.underline} Guzzle uses for
Content-Type. Thus, **Content-Length** is not really required for the
translation request.

The [[Get Sentence
Length]{.underline}](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator?tabs=csharp#get-sentence-length-during-translation)"section
of the [[Quick Start
guide]{.underline}](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/quickstart-translator?tabs=csharp)
explains if you set (when requesting **translation?api-version=3.0** )
the query parameter "**includeSentenceLength=true"**, the input and
output sentence lengths will be also returned in the response.

#### Optional Headers {#optional-headers .list-paragraph}

  ----------------- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Headers           Description
  X-ClientTraceId   A **client-generated GUID** to uniquely identify the request. You can omit this header if you include the trace ID in the query string using a query parameter named ClientTraceId.
  ----------------- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

#### Translate Request Body {#translate-request-body .list-paragraph}

See
[[https://docs.microsoft.com/en-us/rest/api/cognitiveservices/translator/translator/translate\#request-body]{.underline}](https://docs.microsoft.com/en-us/rest/api/cognitiveservices/translator/translator/translate#request-body)

The body of the request is a JSON array. Each array element is a JSON
object with a string property named Text, which represents the string to
translate. The following limitations apply:

-   The array can have at most [25 elements]{.underline}.

-   The entire text included in the request cannot exceed [5,000
    > characters including spaces]{.underline}.

Example input JSON array of two JSON objects:

\[ {\"Text\":\"Freitag\"}, {\"Text\":\"Montag\"} \];

#### Translator 3.0 Optional Query Parameters {#translator-3.0-optional-query-parameters .list-paragraph}

#### Required Parameters {#required-parameters .list-paragraph}

+-----------------+---------------------------------------------------+
| Query parameter | Description                                       |
+-----------------+---------------------------------------------------+
| **api-version** | *Required parameter*.\                            |
|                 | Version of the API requested by the client. Value |
|                 | must be **3.0**.                                  |
+-----------------+---------------------------------------------------+
| **to**          | *Required parameter*.                             |
|                 |                                                   |
|                 | Specifies the language of the output text. The    |
|                 | target language must be one of the [[supported    |
|                 | languages]{.underlin                              |
|                 | e}](https://docs.microsoft.com/en-us/azure/cognit |
|                 | ive-services/translator/reference/v3-0-languages) |
|                 | included in the translation scope. For example,   |
|                 | use to=de to translate to German.\                |
|                 | It\'s possible to translate to multiple languages |
|                 | simultaneously by repeating the parameter in the  |
|                 | query string. For example, use to=de&to=it to     |
|                 | translate to German and Italian.                  |
+-----------------+---------------------------------------------------+

#### Optional Parameters {#optional-parameters-1}

These query paramters apply (TODO: double check) to all five Tranaslor
requst types above.

+---------------------------+-----------------------------------------+
| Query parameter           | Description                             |
+---------------------------+-----------------------------------------+
| **from**                  | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies the language of the input     |
|                           | text. Find which languages are          |
|                           | available to translate from by looking  |
|                           | up [[supported                          |
|                           | l                                       |
|                           | anguages]{.underline}](https://docs.mic |
|                           | rosoft.com/en-us/azure/cognitive-servic |
|                           | es/translator/reference/v3-0-languages) |
|                           | using the translation scope. If the     |
|                           | from parameter is not specified,        |
|                           | automatic language detection is applied |
|                           | to determine the source language.\      |
|                           | \                                       |
|                           | You must use the from parameter rather  |
|                           | than autodetection when using the       |
|                           | [[dynamic                               |
|                           | dictionary]{.underline}](https://do     |
|                           | cs.microsoft.com/en-us/azure/cognitive- |
|                           | services/translator/dynamic-dictionary) |
|                           | feature.                                |
+---------------------------+-----------------------------------------+
| **textType**              | *Optional parameter*.                   |
|                           |                                         |
|                           | Defines whether the text being          |
|                           | translated is plain text or HTML text.  |
|                           | Any HTML needs to be a well-formed,     |
|                           | complete element. Possible values are:  |
|                           | **plain** (default) or **html**.        |
+---------------------------+-----------------------------------------+
| category                  | *Optional parameter*.                   |
|                           |                                         |
|                           | A string specifying the category        |
|                           | (domain) of the translation. This       |
|                           | parameter is used to get translations   |
|                           | from a customized system built with     |
|                           | [[Custom                                |
|                           | Translator]{.underline}](https:         |
|                           | //docs.microsoft.com/en-us/azure/cognit |
|                           | ive-services/translator/customization). |
|                           | Add the Category ID from your Custom    |
|                           | Translator [[project                    |
|                           | details]{.underline}](https://docs.     |
|                           | microsoft.com/en-us/azure/cognitive-ser |
|                           | vices/translator/custom-translator/how- |
|                           | to-create-project#view-project-details) |
|                           | to this parameter to use your deployed  |
|                           | customized system. Default value is:    |
|                           | general.                                |
+---------------------------+-----------------------------------------+
| profanityAction           | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies how profanities should be     |
|                           | treated in translations. Possible       |
|                           | values are: NoAction (default), Marked  |
|                           | or Deleted. To understand ways to treat |
|                           | profanity, see [[Profanity              |
|                           | handling]{.underli                      |
|                           | ne}](https://docs.microsoft.com/en-us/a |
|                           | zure/cognitive-services/translator/refe |
|                           | rence/v3-0-translate#handle-profanity). |
+---------------------------+-----------------------------------------+
| profanityMarker           | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies how profanities should be     |
|                           | marked in translations. Possible values |
|                           | are: Asterisk (default) or Tag. To      |
|                           | understand ways to treat profanity, see |
|                           | [[Profanity                             |
|                           | handling]{.underli                      |
|                           | ne}](https://docs.microsoft.com/en-us/a |
|                           | zure/cognitive-services/translator/refe |
|                           | rence/v3-0-translate#handle-profanity). |
+---------------------------+-----------------------------------------+
| includeAlignment          | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies whether to include alignment  |
|                           | projection from source text to          |
|                           | translated text. Possible values are:   |
|                           | true or false (default).                |
+---------------------------+-----------------------------------------+
| **includeSentenceLength** | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies whether to include sentence   |
|                           | boundaries for the input text and the   |
|                           | translated text. Possible values are:   |
|                           | true or false (default).                |
+---------------------------+-----------------------------------------+
| suggestedFrom             | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies a fallback language if the    |
|                           | language of the input text can\'t be    |
|                           | identified. Language autodetection is   |
|                           | applied when the from parameter is      |
|                           | omitted. If detection fails, the        |
|                           | suggestedFrom language will be assumed. |
+---------------------------+-----------------------------------------+
| fromScript                | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies the script of the input text. |
+---------------------------+-----------------------------------------+
| toScript                  | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies the script of the translated  |
|                           | text.                                   |
+---------------------------+-----------------------------------------+
| allowFallback             | *Optional parameter*.                   |
|                           |                                         |
|                           | Specifies that the service is allowed   |
|                           | to fall back to a general system when a |
|                           | custom system does not exist. Possible  |
|                           | values are: true (default) or false.\   |
|                           | \                                       |
|                           | allowFallback=false specifies that the  |
|                           | translation should only use systems     |
|                           | trained for the category specified by   |
|                           | the request. If a translation for       |
|                           | language X to language Y requires       |
|                           | chaining through a pivot language E,    |
|                           | then all the systems in the chain       |
|                           | (X-\>E and E-\>Y) will need to be       |
|                           | custom and have the same category. If   |
|                           | no system is found with the specific    |
|                           | category, the request will return a 400 |
|                           | status code. allowFallback=true         |
|                           | specifies that the service is allowed   |
|                           | to fall back to a general system when a |
|                           | custom system does not exist.           |
+---------------------------+-----------------------------------------+

#### Example Response Object {#example-response-object .list-paragraph}

**Input Request Body**

The input is an json array of two json objects:

\[ {\"text\":\"Freitag\"}, {\"text\":\"Montag\"} \];

**Response Object**

This is the joson response object:

\[{\"translations\": \[

{

\"text\": \"Friday\",

\"to\": \"en\",

\"sentLen\": {

\"srcSentLen\": \[

7

\],

\"transSentLen\": \[

6

\]

}

}

\]

},

{

\"translations\": \[

{

\"text\": \"Monday\",

\"to\": \"en\",

\"sentLen\": {

\"srcSentLen\": \[

6

\],

\"transSentLen\": \[

6

\]

}

}

\]

}

\]