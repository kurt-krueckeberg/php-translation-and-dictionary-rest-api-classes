<section>

# Collins API

## Documentation

- PDF [documentation](./collins-api-documentation.pdf)

Comment: It seems to have a number of errors in it. The endpoint given is wrong. `https://api.collins.com` does not exist but `https://api.collinsdictionary.com` does. The get-entry call returns json or xml, so why does the `format` 
query parameter say xml or hml instead?

### API Client Libraries

- Client libraries in [several programming languages](http://dps.api-lib.idm.fr/) including PHP.

- Documentation for using the [PHP client library](http://dps.api-lib.idm.fr/libraries.html#php).

- [Sample PHP code](http://dps.api-lib.idm.fr/download.html#php) that uses the PHP client library. 

### Demo

- Online [Demo of API](https://api.collinsdictionary.com/apidemo/). You only supply your API key.

## Basic Usage

### Base endpoint

The base URL is `https://api.collins.com/api/v1`

### Authorization

The header key should be:

- `{accessKey}`: the user access key (a 64 characters text provided for the targetting API)

### Requests

You first have to search for the word like so

- endpoint:  https://api.collinsdictionary.com/api/v1
- dict code: german-english     
- request: search -- Q: What is the route?
- max resulst: 10
- results list page index: 1:w

This will return this:

```json
{
    "resultNumber": 6,
    "results": [
        {
            "entryLabel": "Handeln",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/handeln_2",
            "entryId": "handeln_2"
        },
        {
            "entryLabel": "handeln",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/handeln_1",
            "entryId": "handeln_1"
        },
        {
            "entryLabel": "abhandeln",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/abhandeln_1",
            "entryId": "abhandeln_1"
        },
        {
            "entryLabel": "aushandeln",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/aushandeln_1",
            "entryId": "aushandeln_1"
        },
        {
            "entryLabel": "einhandeln",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/einhandeln_1",
            "entryId": "einhandeln_1"
        },
        {
            "entryLabel": "herunterhandeln",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/herunterhandeln_1",
            "entryId": "herunterhandeln_1"
        }
    ],
    "dictionaryCode": "german-english",
    "currentPageIndex": 1,
    "pageNumber": 1
}
```

You then search the entryLable for your input string and use the entryID, to look up the definitions, like so:

```bash
GET /dictionaries/{dictCode}/entries/{entryId}?format={format} HTTP/1.0
```

The parameters are:

- `{dictCode}`: the dictionary code. (eg. british)
- `{entryId}`: the entry ID.
- `{format}`: the output format of the entry. (html or xml)
- `{hostname}`: the web site name (the full domain name).

</section>
