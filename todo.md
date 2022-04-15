1. Question: Are the input and output language two-letter abbreviations the same as those used by deepl, Azure and IBM? That is, is there a standard for the language abbreviations?

2.  Change examples_ file name to NOT have ':' and to have AM or PM:

- [date()](https://www.php.net/manual/en/function.date.php)

- `date()` [format options](https://www.w3schools.com/php/func_date_date.asp)

```php
// Prints the day, date, month, year, time, AM or PM
echo date("l jS \of F Y h:i:s A") . "\n";
```
date("m-d-y:H:i:s")

3. Make ~/rest-translators a github respoistory-backed composer package.

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)

4. Make ~/e a github respoistory-backed composer package that usese the rest-tranlators pakckage.
