<section>

# Collins API

## Documentation

The PDF documentation seems to have a number of errors in it; for example, the endpoint `https://api.collins.com` does not exist (while `https://api.collinsdictionary.com` does). The get-entry call returns json or xml: therfore what use is the `format` 
query parameter, which supposely can be `xml` or 'html`?

- [API PDF documentation](./collins-api-documentation.pdf)

### API Client Libraries

- Client libraries are provided in [several programming languages](http://dps.api-lib.idm.fr/) including PHP,.

- The documentation for [how to use PHP client library](http://dps.api-lib.idm.fr/libraries.html#php).

- [Sample PHP code](http://dps.api-lib.idm.fr/download.html#php) that uses the PHP client library. 

### Demo

- Online [Demo of API](https://api.collinsdictionary.com/apidemo/). You must supply your API key.

## Basic Usage

### Base endpoint

The base URL is `https://api.collins.com/api/v1`

### Authorization

The header key should be:

- `{accessKey}`: the user access key (a 64 characters text provided for the targetting API)

### Requests

For determing whethera word is in the dictionary, there is more than one search method. You can  

#### Search for a word

`search` finds all entries in the dictionary that contain the word the input word. For example, if you search for the German word `Handeln`:

API: `/api/v1/dictionaries/{dictionaryCode}/search/?q={searchWord}&pagesize={pageSize}&pageindex={pageIndex}`

Input:

1. dictionaryCode - the dictionary code.

2. searchWord - the word we are searching for.

3. pageSize - the number of results per result page [optional, 10 by default, maximum allowed 100]

4. pageIndex – the index of the result page to return [optional, default = 1 (the first page)]

Returns:

1. dictionaryCode

2. resultNumber – the total number of results

3. pageNumber – the index of the last result page

4. currentPageIndex – the index of the current result page

5. results - an array of entries sorted the same way as in the main dictionary (empty if no results are found):

   - entryId - the id of the entry used to look up the actual definition.

   - entryLabel - the headword, the actual word in the dictionary 

   - entryUrl - the direct url to the entry page on the main Collins website

Example:

```html
/api/v1/dictionaries/german-english/search/?q=Handeln&pagesize=10&pageindex=1
```

will return this json object:

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

You then search the `entryLabel` for your input string and use its `entryID` to look up the definitions:

```bash
GET /dictionaries/{dictCode}/entries/{entryId}?format={format} HTTP/1.0
```

Input:

- `{dictCode}`: the dictionary code. (eg. british)

- `{entryId}`: the entry ID.

- `{format}`: the output format of the entry. (html or xml)

- `{hostname}`: the web site name (the full domain name).

</section>
