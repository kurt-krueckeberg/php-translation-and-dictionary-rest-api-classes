- Abandon the Pons API since its returned content contains embedded html, including many `<span class="xyz">, which are tied to undocumented CSS. 

- Find CSS to style Systran dictionary definitions

- It is wrong to use `urlencode($input_text)` during `DictionrayInterface::lookup()`. 

- Create PonsResultsIterator. See the comments in `PonsDictionary::lookup()` on how to do this.

- Implement a `check_iso_code(string $lang) : bool`

  1. classes implementing from DictionaryInterface
  2. classes implementing from TranslateInterface

- Chankge composer.json so that

  - it is a github respoistory-backed composer package.

  - autolaoding is generated automatically

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)
