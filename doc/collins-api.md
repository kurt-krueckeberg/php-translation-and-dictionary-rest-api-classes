<section>

# Collins API

## Documentation

The PDF documentation seems to have a number of errors in it; for example, the endpoint `https://api.collins.com` does not exist (while `https://api.collinsdictionary.com` does). The get-entry call returns json or xml: therfore what use is the `format` 
query parameter, which supposely can be `xml` or 'html`?

- [API PDF documentation](./collins-api-documentation.pdf)

### API Client Libraries

- Collins does provide dlient libraries in [several programming languages](http://dps.api-lib.idm.fr/) including PHP.

- The documentation for [using the PHP client library](http://dps.api-lib.idm.fr/libraries.html#php).

- [Sample PHP code](http://dps.api-lib.idm.fr/download.html#php) that uses the PHP client library. 

### Demo

The [online demo tool](https://api.collinsdictionary.com/apidemo/)is an excellent aid in understanding the API documentation. To use it, you must supply your API key.

## Basic Usage

### API endpoint

`https://api.collins.com/api/v1`

### Authorization

The header key should be:

- `{accessKey}`: the user access key (a 64 characters text provided for the targetting API)

### Requests

The output returned is html whose tags contain style information. I manually copied and pasted (from the Collins website) what I hope is all the style information. It is in [src/collins.css](src/collins.css).
See the srouce code documentation in src/CollinsGermanDictionary.php

</section>
