# Translators and Dcitionary APIS

## Translators and Dictionaries

- Azure/Microsoft $29/month.

  - Dictionary has only one-word definitions. But has an example sentences lookup feature!

- Deepl Translator 

  - No Dictionary

- IBM Watson Translator

  - docs link?

- Yandex Their price seems quite good. Tehy are the Russian "Google", registerd in the Netherlands

Their [Dictionary API](https://yandex.com/dev/dictionary/) offers ???#er??? requests per ???month. They also offer a translation service, which seems to require a separate key from the dictionary key?

- [Systran.net](https://www.systran.net/en/translate/)

  - 14 day [free trial](https://www.systran.net/en/free-trial/)
   
  - They support tons of languages 

  - Pricing: Lite Plan cost: $5.50/month

  - [Systrans Translation API](https://docs.systran.net/translateAPI) 

- Linguatools has DataPackages and a Language API.  Probably is using a 3rd-party translation service.

  -  Free: 1,000 verbs/month? Conjugation API Docs

- [Collins API](https://www.collinsdictionary.com/collins-api) allows 5,000 free calls per month. 

They offer a REST API for their **Concise German English Dictionary**. Apply for an API key [here](https://blog.collinsdictionary.com/collins-api-apply-for-a-key/).

- PONS Dictinary API

PONS Dictinary API [main page](https://en.pons.com/p/online-dictionary/developers/api). PONS REST API allows 1,000 quereires per month. If more querires are needed:

Problems: The PONS REST dictinary `lookup` results are tersely well documented. There is no sample code, either. Some of the returned text contains embedd html `<span class="...">` tags without any accompanying .CSS file.

> The POD-API is provided to you directly with a free quota of 1000 reference queries per month.

> If your usage will exceed the free quota above, please contact us directly on u.keppler@pons.de, and we’ll arrange terms and conditions for your license. The standard license fee is 3,- Euros per 1000 requests. 
Other pricing models, such as flat fees, limited access to a subset of dictionaries only etc. are subject to negotiation. Talk to us and together we will find out how you can benefit from PONS.

[documentation](https://en.pons.com/p/files/uploads/pons/api/api-documentation.pdf)

To get of supported bilingual dictinaries:

```bash
wget -O - --no-check-certificate "https://api.pons.com/v1/dictionaries?language=de"
```

- dict.cc 

dict.cc is a downloadable text [file](https://www1.dict.cc/translation_file_request.php?l=e) with various delimited fields. There is no real documentation describing these fields or sample code to show how to
best parse it.

- DING (Dictionary Nice Grep)

[ding](https://www-user.tu-chemnitz.de/~fri/ding/) is a downloadable text files that is (I think) designed to be grep'able.

- Oxford Dictionarys API

[page](https://developer.oxforddictionaries.com/).  The REST API has a *limited set of supported language*. **German is not supported.**
