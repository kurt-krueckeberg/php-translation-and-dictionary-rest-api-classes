# Documentation 

This is an XML-driven set of translation classes for issuing REST translation calls to [DEEPL](https://www.deepl.com/docs-api), [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)
and [IBM Watson Translator](https://cloud.ibm.com/docs/language-translator/getting-started.html#gettingstarted) (not yet implemnted). Client's use the class `Translator` class that implements `TranslatorInterface`.

The underlying REST client (in the implementation) is [Guzzle](https://docs.guzzlephp.org/en/stable/).

Usage:

1. Generate autoloaded using **composer**:

```bash
$ composer dump-autoload
```

Add your **DEEPL** and **Azure Translator** keys to **sample-config.xml** and rename it **config.xml**.

2. In your code call, for example, `Translator::createFromXML("config.xml", "d");`, where the 2nd paramter is one-letter abbreviation of the provider:

| Provider | Abbreviation | XML `<provider>` node |
|----------|--------------|-------------------| 
| DEEPL| d | `<provider name="deepl" abbrev="d">` |          
| Microsoft Azure Translator| m | `<provider name="Azure" abbrev="m">` |
| IBM Watson Translator | i |  `<provider name="IBM" abbrev="i">` | 

3. Call `Translator:: translate(string $text, string $dest_lang, $source_lang="");`

   The default source language, if specified in config.xml, will be used; otherwise, it will be auto-detected.

## Comments:

The various REST translators can automatically detect the source (input) language, but you can alos set a default source language in `config.xml`.
   
Sample code:

```php
<?php
declare(strict_types=1);
use Translators\Translator;
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;

include "vendor/autoload.php";

// Passing configuration XML file and provider one-letter abbreviation
$trans = Translator::createFromXML("config.xml", "d");

$input = array("Guten Tag!", "Guten Morgen");

try {

  foreach ($input as $text) // Translate German (specified in config.xml) into Russian 
     $translation = $trans->translate($text, "RU");

  echo $translation . "\n";

} catch (RequestException $e) { 

    // If a response code was set, get it.
    if ($e->hasResponse()) echo "Response Code = " . $e->getResponse()->getStatusCode();

    else echo  "No response from server.";

    echo "\nException: message = " . $e->getMessage() . "\n";

} catch (\Exception $e) {
    
    echo "\nException: message = " . $e->getMessage() . "\n";
} 

```  

## XML

### todo

Describe config.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<providers>
    <provider name="deepl" abbrev="d">
        <settings>   
           <baseurl>https://api-free.deepl.com/v2</baseurl>
           <credentials method="header">
               <header name="Authorization">DeepL-Auth-Key ???????????????????????????????????????</header>
           </credentials>
           <Content-Type>application/json; charset=UTF-8</Content-Type>
           <implementation>Translators\DeeplTranslator</implementation>
           <query> 
              <from name="source_lang"></from> <!-- A value is not required -->
              <to name="target_lang" />
           </query>
        </settings>
        <requests>
           <request type="translation"> 
              <route>v2/translate</route>
              <method>GET</method>
              <!-- The presence of the `input="text"` attribute implies the input text is a query parameter named 'text'. If the input attribute is not present,
                json input is required. The name attribute is present if and only if the  implementation class is Translator.   -->
           </request>
        </requests>
   </provider>
   <provider name="Microsoft" abbrev="m">
        <settings> 
           <baseurl>https://api.cognitive.microsofttranslator.com</baseurl>
           <credentials method="header">
              <header name="Ocp-Apim-Subscription-Key">???????????//</header> 
              <header name="Ocp-Apim-Subscription-Region">??????</header>
           </credentials>
           <Content-Type>application/json; charset=UTF-8</Content-Type>
           <implementation>Translators\AzureTranslator</implementation>
           <query> 
               <parm name="api-version">3.0</parm>
               <parm name="textType">plain</parm>
               <from name="from">DE</from> <!-- A value is not required -->
               <to name="to" />
           </query>
        </settings>
        <requests>
          <request type="translation">
          <!--  Azure Translator 3.0 also supports "dictionary lookups" and dictionary examples.
              
                   1. translation
                   2. dictionary look up
                   3. dictionary examples
              
                 Each type of three request types above has a different "route" (that is appended to the base URL)
              
                 1. Translation request:
              
                       https://api-nam.cognitive.microsofttranslator.com/translate
              
                 2. Dictionary look up 
              
                       https://api-nam.cognitive.microsofttranslator.com/dictionary/lookup
              
            -->
                  <!-- These are settings that apply to all types of requests \-\- text translation, dictionary lookup, etc -->
             <route>translate</route> 
             <method>POST</method> 
          </request>
          <request type="dictionary">
          <!--  Azure Translator 3.0 also supports "dictionary lookups" and dictionary examples.
              
                   1. translation
                   2. dictionary look up
                   3. dictionary examples
              
                 Each type of three request types above has a different "route" (that is appended to the base URL)
              
                 1. Translation request:
              
                       https://api-nam.cognitive.microsofttranslator.com/translate
              
                 2. Dictionary look up 
              
                       https://api-nam.cognitive.microsofttranslator.com/dictionary/lookup
              
            -->
                  <!-- These are settings that apply to all types of requests \-\- text translation, dictionary lookup, etc -->
             <implementation>Translators\AzureTranslator</implementation>
             <route>Dictionary/Lookup</route> 
             <method>POST</method> 
          </request>
      </requests>
    </provider>
    <provider name="ibm" abbrev="i">
        <settings>   
          <baseurl></baseurl>
          <credentials method="custom">
             <!-- 
             I believe basic authorization is used in which a username and password are passed, separated from each other by a colon.
             The username is 'apikey' and the password is your private api-key.
  
             Bear token is also supported and recommended for production code.
             -->
             <header name="apikey">ApiKey-????????????????????????????????????</header>
          </credentials>   
          <credentials method="token">
          </credentials>
          <Content-Type>application/json; charset=UTF-8</Content-Type>
          <implementation>Translators\IbmTranslator</implementation>
          <query> 
             <parm name="????">DE</parm>
             <parm name="???">to</parm>
          </query>
        </settings>
        <requests>
           <request type="translation"> 
              <route>translate</route>
              <method>GET/POST???</method>
           </request>
        </requests>
     </provider>
</providers>
```

