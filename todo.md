- public constructors of rest client classes allows incorect SimpleXMLElemtns's to be passed to their constuctors.

- Change sample-config.xml to match onfig.xml.

1. What type should `lookup` return? 

2. Implement `getLangauges()` interface method  returns the ISO codes and there respective countries as array of codes and Lanagues?

- Both deepl and Azure take mostly two-letter codes, but for some languages there take 4 letter, hyphenated codes. Pons seems to take only two-letter codes.

3. Should `lookup` return an array with the heaqdword as the key and the value a subarrary of definitions?

4.  Change examples_ file name to NOT have ':' and to have AM or PM:

- [date()](https://www.php.net/manual/en/function.date.php)

- `date()` [format options](https://www.w3schools.com/php/func_date_date.asp)

```php
// Prints the day, date, month, year, time, AM or PM
echo date("l jS \of F Y h:i:s A") . "\n";
```
date("m-d-y:H:i:s")

5. Make ~/rest-translators a github respoistory-backed composer package.

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)

5. Make ~/e a github respoistory-backed composer package that usese the rest-tranlators pakckage.

### PHP Links

- [PHP Closuers](https://www.php.net/manual/en/functions.anonymous.php)

- [PHP Callbacks](https://www.php.net/manual/en/language.types.callable.php)


