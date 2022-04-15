1. Figure out which subset of world languages are supported respectively by Deepl, Azure and PONS. 

- Both deepl and Azure take mostly two-letter codes, but for some languages there take 4 letter, hyphenated codes. Pons seems to take only two-letter codes.

- The PONS dictinaries query paramter seems to be determined by the input and output language. Confirm this and document how the dectinary is derived from the input and output languages, if in fact is.

PONS

Pons returns more than just translations. It returns information that is not throoughly documented, but would be clear if I could find the CSS that pons uses to format translation results.

Probably the best thing , if I can't find th CSS, is stop in the debugger, and find where the translations are: Under what top-level key are they, what 2nary key, etc.

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
