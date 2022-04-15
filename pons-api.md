# PONS Dictinary API

PONS Dictinary API [main page](https://bg.pons.com/p/online-dictionary/developers/api). PONS REST PAI allows 1,000 quereires per month. You can contact them at that prior page if more querires are needed.

> The POD-API is provided to you directly with a free quota of 1000 reference queries per month.

If your needs exceed this:

> If your usage will exceed the free quota above, please contact us directly on u.keppler@pons.de, and we’ll arrange terms and conditions for your license. The standard license fee is 3,- Euros per 1000 requests. 
Other pricing models, such as flat fees, limited access to a subset of dictionaries only etc. are subject to negotiation. Talk to us and together we will find out how you can benefit from PONS.

[documentation](https://bg.pons.com/p/files/uploads/pons/api/api-documentation.pdf)

## List of Bilingual Dictionaries

To get of supported bilingual German dictinaries:

```bash
wget -O - --no-check-certificate "https://api.pons.com/v1/dictionaries?language=de"
```

The German => English dictionary is: **deen**; i.e. Duetsch to Englisch. 

## Dictionary Queries

|Name|Type|Description|
|----------------------|
|X-Secret|HTTP-Header|The supplied secret|
|q|Request-Parameter|Search term (URL-escaped UTF-8)|
|l|Request-Parameter|Dictionary (i.e. deen,deru) - consult the search url on the result page of a search (on our website).  Note: This does not imply a direction, i.e. 'deen' may yield results in both german->english and english->german directions. To specify a direction, use the in-parameter|
|in|Request-Parameter|[optional] Specify the source language (the language of the search term)|

