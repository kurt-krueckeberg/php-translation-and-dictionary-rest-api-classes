See [PHP 8.1 Enums](https://stitcher.io/blog/php-enums)

1. Decide what sort of settings each implemtation needs....mainly keys headers and the REST endpoints-- anything else?

2. Base on #1 above (which likely will require the ClassID to have an interface mthod that returns a configuration. Add to Classmapinterface a `get_config()` method.
According to  [PHP 8.1 Enums](https://stitcher.io/blog/php-enums) you can't use Enumerations as array keys, though there is an RFC to do this. However, check out [Getting values for an enum?](https://stackoverflow.com/questions/71235907/getting-values-for-an-enum)
You could also dynamically build the static array once:

  `$class_map[ClassID::Leipzig->value] = ['class' => 'SentenceFetcher', 'config' => 'Leipzigconfig'];`
   ditto for each Enum::cases() type

 

- Implement a `check_iso_code(string $lnag) : bool` in, say, a IsoCodes trait or in a base class for 

  1. classes implementing from DictionaryInterface
  2.  classes implementing from TranslateInterface

- Change confiug.xml to be class `Configuration` with `static getConfig(ClassID $id)` that returns an array of settings.

- Implement SystransTranslator after getting a trial 

- If needed, change sample-config.xml to match onfig.xml.

1. Decide what type should `lookup` return? 

2. Make ~/rest-translators a github respoistory-backed composer package.

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)

3. Make ~/e a github respoistory-backed composer package that usese the rest-tranlators pakckage.

### PHP Links

- [PHP Closuers](https://www.php.net/manual/en/functions.anonymous.php)

- [PHP Callbacks](https://www.php.net/manual/en/language.types.callable.php)


4.  Change examples_ file name to NOT have ':' and to have AM or PM:

- [date()](https://www.php.net/manual/en/function.date.php)

- `date()` [format options](https://www.w3schools.com/php/func_date_date.asp)

```php
// Prints the day, date, month, year, time, AM or PM
echo date("l jS \of F Y h:i:s A") . "\n";
```
date("m-d-y:H:i:s")

PHP 8.1 features:

https://php.watch/versions/8.1
