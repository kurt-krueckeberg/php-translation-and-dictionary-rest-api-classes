# Documentation 

This is an XML-driven set of translation classes for issuing REST translation calls to [DEEPL](https://www.deepl.com/docs-api), [Azure Translator](https://docs.microsoft.com/en-us/azure/cognitive-services/translator/)
and [IBM Watson Translator](https://cloud.ibm.com/docs/language-translator/getting-started.html#gettingstarted) (which is not yet implemnted). Client's use the class `Translator` class that implements `TranslatorInterface`.

The underlying REST client (in the implementation) is [Guzzle](https://docs.guzzlephp.org/en/stable/).

**NOTE:** You must obtain a DEEPL or Azure account and insert your account's keys into confix.xml. The DEEPL free account has a monthly limit. Azure is a non-free subscription service.

Usage:

1. After cloning the repository, do:

```bash
 $ composer update
```

This will install Guzzle. Then generate the autoloader for the translation classes in the **src** folder:

```bash
 $ composer dump-autoload
```

2. Be sure the include the autoloader in your client code:

```php
include vendor/autoload.php
```

Add your **DEEPL** and/or **Azure Translator** keys to **sample-config.xml** and rename it **config.xml**.

3. Edit **test.php** and change the 2nd paramter of `Translator::createFromXML("config.xml", "d");` to be your translator of choice:: **"d"** for DEEPL, **"m"** for Microsoft's Azure Translator or **"i"** for IBM's Watson Translator (which is not yet implemented):

```php
   // This will instantiate the AzureTranslator class that implements TranslateInterface 
   $trans = Translator::createFromXML($xml, "m");
```
Table of providers and their abbreviations:

| Provider | Abbreviation | XML `<provider>` node |
|----------|--------------|-------------------| 
| DEEPL| d | `<provider name="deepl" abbrev="d">` |          
| Microsoft Azure Translator| m | `<provider name="Azure" abbrev="m">` |
| IBM Watson Translator | i |  `<provider name="IBM" abbrev="i">` | 

**NOTE:** You must obtain a DEEPL or Azure account and insert your account's keys into config.xml. The DEEPL free account has a monthly limit. Azure is a non-free subscription service.
## Comments:

The various REST translators can automatically detect the source (input) language, but you can specify the source language when calling `translate`.  Sample code:

```php
<?php
declare(strict_types=1);
use Translators\Translator;
use Guzzle\Exception\RequestException;
use Guzzle\Exception\ClientException;

// After cloing the repository, do 
// $ composer dump-autoload
include "vendor/autoload.php";

$xml = \simplexml_load_file("config.xml");

$trans = Translator::createFromXML($xml, "m");
 
$input = array("Guten Tag!", "Guten Morgen");

try {

  foreach ($input as $text) { 
  
     // Translate from German into Russian. If "DE" omitted
     // the input language will be auto-detected.
     $translation = $trans->translate($text, "RU", "DE"); 

     echo $translation . "\n";
  }
  
  echo "Do dictionary lookup..\n";
  
  // Note: Only AzureTranslator supports dictionary lookup
  // lookup the German word "Anlagen" and get an English one-word definition.
  $dict = $trans->lookup("Anlagen", "DE", "EN");

  print_r($dict);

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
    <provider name="leipzig" abbrev="l">
        <settings>      
           <credentials method="none"></credentials>
           <baseurl>http://api.corpora.uni-leipzig.de/ws</baseurl> <!-- https?? -->
           <Content-Type>application/json; charset=UTF-8</Content-Type>  <!-- This seems to be the default of RST APIs. It is the Guzzle default, right? -->
           <query> 
               <parm name="offset">0</parm> 
               <parm name="limit">10</parm> 
           </query> 
        </settings>
        <requests> 
           <request type="sentences"> 
              <route>sentences/deu_news_2012_1M/sentences</route> 
              <method>GET</method> 
          </request>
        </requests>
   </provider>
   <provider name="deepl" abbrev="d">
        <settings>   
           <baseurl>https://api-free.deepl.com/v2</baseurl>
           <credentials method="header">
               <header name="Authorization">DeepL-Auth-Key ???????????????????????????????????????</header>
           </credentials>
           <Content-Type>application/json; charset=UTF-8</Content-Type>
           <implementation>Translators\DeeplTranslator</implementation>
           <query> 
              <from name="source_lang" />
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
               <from name="from" />
               <to name="to" />
           </query>
        </settings>
        <requests>
          <request type="translation">
             <route>translate</route> 
             <method>POST</method> 
          </request>
          <request type="dictionary">
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
              <header name="apikey">ApiKey-????????????????????????????????????</header>
          </credentials>   
          <credentials method="token">
          </credentials>
          <Content-Type>application/json; charset=UTF-8</Content-Type>
          <implementation>Translators\IbmTranslator</implementation>
          <query> 
             <parm name="????">DE</parm>
             <parm name="???">to</parm>
             <from name="from" /> 
             <to name="to" />
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
kurt@pop-os:~/rest-translators$ cat sample-config.xml 
kurt@pop-os:~/rest-translators$ cat sample-config.xml 
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
              <from name="source_lang" />
              <to name="target_lang" />
           </query>
        </settings>
        <requests>
           <request type="translation"> 
              <route>v2/translate</route>
              <method>GET</method>
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
               <from name="from" />
               <to name="to" />
           </query>
        </settings>
        <requests>
          <request type="translation">
             <route>translate</route> 
             <method>POST</method> 
          </request>
          <request type="dictionary">
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
              <header name="apikey">ApiKey-????????????????????????????????????</header>
          </credentials>   
          <credentials method="token">
          </credentials>
          <Content-Type>application/json; charset=UTF-8</Content-Type>
          <implementation>Translators\IbmTranslator</implementation>
          <query> 
             <parm name="????">DE</parm>
             <parm name="???">to</parm>
             <from name="from" /> 
             <to name="to" />
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

