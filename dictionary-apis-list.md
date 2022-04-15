# Some Dictionary APIs

## PONS Dictinary API

PONS Dictinary API [main page](https://en.pons.com/p/online-dictionary/developers/api). PONS REST PAI allows 1,000 quereires per month. You can contact them at that prior page if more querires are needed.

> The POD-API is provided to you directly with a free quota of 1000 reference queries per month.

If your needs exceed this:

> If your usage will exceed the free quota above, please contact us directly on u.keppler@pons.de, and we’ll arrange terms and conditions for your license. The standard license fee is 3,- Euros per 1000 requests. 
Other pricing models, such as flat fees, limited access to a subset of dictionaries only etc. are subject to negotiation. Talk to us and together we will find out how you can benefit from PONS.

[documentation](https://en.pons.com/p/files/uploads/pons/api/api-documentation.pdf)

To get of supported bilingual dictinaries:

```bash
wget -O - --no-check-certificate "https://api.pons.com/v1/dictionaries?language=de"
```

## dict.cc 

dict.cc has a download text [file](https://www1.dict.cc/translation_file_request.php?l=e) with delimited fields. Logi to parse it is not readily available.

## DING (Dictionary Nice Grep)

[ding](https://www-user.tu-chemnitz.de/~fri/ding/) also have a downloadable text files that is (I think) designed to be grep'able.


## Oxford Dictionarys API

[page](https://developer.oxforddictionaries.com/).  There is a limited set of languages supported by their API, and German is not (I dont' think) included.

## Collins Bilingula API

They offer a Concise German English dictinary.

- [Collins API](https://www.collinsdictionary.com/collins-api) allows 5,000 free calls per month. 

- Apply for key [here](https://blog.collinsdictionary.com/collins-api-apply-for-a-key/)
