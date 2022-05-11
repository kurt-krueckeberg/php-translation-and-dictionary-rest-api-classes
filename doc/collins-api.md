# Collins API

## Documentation

- PDF [documentation](./collins-api-documentation.pdf)

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

The basic usage of the API is composed as (for JSON format):

```bash
GET /dictionaries/{dictCode}/entries/{entryId}?format={format} HTTP/1.0
```

The parameters are:

- `{dictCode}`: the dictionary code. (eg. british)
- `{entryId}`: the entry ID. (eg. car)
- `{format}`: the output format of the entry. (html or xml)
- `{hostname}`: the web site name (the full domain name).
