# Translators and Dcitionary APIS

## Translators

- Azure/Microsoft $29/month.

- Deepl Translator 

- IBM Watson Translator

- Yandex Their price seems quite good.

## Dictionaries

- Azure Translator

Problems: Its `lookup` method only returns a one-word definition. 

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

[page](https://developer.oxforddictionaries.com/).  The REST API has a limited set of supported language for dictionary lookup. German is not one of them.

- [Collins API](https://www.collinsdictionary.com/collins-api) allows 5,000 free calls per month. 

They offer a REST API for their **Concise German English Dictionary**. Apply for an API key [here](https://blog.collinsdictionary.com/collins-api-apply-for-a-key/).

- Yandex

Their [Dictionary API](https://yandex.com/dev/dictionary/) offers ???#er??? requests per ???month. They also offer a translation service, which seems to require a separate key from the dictionary key?

The Yandex translator seems to be part of the Yandex Cloud. See docs/yandex.md. 

