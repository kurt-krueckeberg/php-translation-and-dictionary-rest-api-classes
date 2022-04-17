1. Add a `getLangauges()` interface mthod to Translate- and or DicionaryInterface that returns the ISO codes and there respective countries.

2. Have class Transaltor extend ApiBase, if this makes sense; that is, if the the reusable methods in class Translator can be put into a REST base class -- which currently is named `ApiBase` -- 
that:

  1. reads config.xml and finds the provider based on its abbreviation

  2. Gets these common settings for all Rest APIs:
  
     - baseurl/endpoint
     - route
     - method
  
  3. Calls the abstract method `setOptions($provider)` that derived classes will implement to set their own $options member varialbe.
  
  4. It will have a base-bones `request(array $options)` method to issue the api call, which will call the abtract method `process_response(Guzzle\Ps7\Response $res)`
     that derived class will implement to get the data they need.

**Note:**

- Both deepl and Azure take mostly two-letter codes, but for some languages there take 4 letter, hyphenated codes. Pons seems to take only two-letter codes.

- The PONS dictinaries query paramter seems to be determined by the input and output language. Confirm this and document how the dectinary is derived from the input and output languages, if in fact is.

3.  Change examples_ file name to NOT have ':' and to have AM or PM:

- [date()](https://www.php.net/manual/en/function.date.php)

- `date()` [format options](https://www.w3schools.com/php/func_date_date.asp)

```php
// Prints the day, date, month, year, time, AM or PM
echo date("l jS \of F Y h:i:s A") . "\n";
```
date("m-d-y:H:i:s")

4. Make ~/rest-translators a github respoistory-backed composer package.

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)

5. Make ~/e a github respoistory-backed composer package that usese the rest-tranlators pakckage.
