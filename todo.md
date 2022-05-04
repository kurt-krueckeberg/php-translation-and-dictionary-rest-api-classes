- Abandon the Pons API since its returned content contains embedded html, including many `<span class="xyz">, which are tied to undocumented CSS. 

- Try using the CSS from these sites: 

  - [PONS DE -> EN](https://en.pons.com)

  - [Collins DE -> EN diciionary](https://www.collinsdictionary.com/dictionary/german-english/handeln)

  - [Cambridge DE -> EN](https://dictionary.cambridge.org/dictionary/german-english/handeln?q=Handeln)

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
