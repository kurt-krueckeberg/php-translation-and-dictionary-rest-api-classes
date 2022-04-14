1.  Create output file with time-stamp using `date()` function. Something similiar to `date("H:i:s")`. PHP's date() function can return both month, day and year, and also the hour, minute and second.

See:

- [date()](https://www.php.net/manual/en/function.date.php)

- `date()` [format options](https://www.w3schools.com/php/func_date_date.asp)

```php
// Prints the day, date, month, year, time, AM or PM
echo date("l jS \of F Y h:i:s A") . "<br>";
```
date("m-d-y:H:i:s")

2. Make ~/rest-translators a github respoistory-backed composer package.

3. Make ~/e a github respoistory-backed composer package that usese the rest-tranlators pakckage.
