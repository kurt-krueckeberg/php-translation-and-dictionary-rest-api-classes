1. Add a `getLangauges()` interface mthod to Translate- and or DicionaryInterface that returns the ISO codes and there respective countries.

2. Pass the $options array by reference.
   

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
