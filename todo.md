- Abandon the Pons API since its returned content contains embedded html, including many `<span class="xyz">, which are tied to undocumented CSS. 

- Try using the CSS from these sites: 

  - [PONS DE -> EN](https://en.pons.com)

  - [Collins DE -> EN diciionary](https://www.collinsdictionary.com/dictionary/german-english/handeln)

  - [Cambridge DE -> EN](https://dictionary.cambridge.org/dictionary/german-english/handeln?q=Handeln)

See these links on howot:

**Extracting CSS for an element**:

- [#1](https://stackoverflow.com/questions/5296622/how-can-i-grab-all-css-styles-of-an-element)

- [#2](https://getcssscan.com/blog/how-to-inspect-copy-element-css#:~:text=First%2C%20hover%20over%20the%20element,choose%20the%20option%20%E2%80%9CInspect%E2%80%9D.&text=On%20the%20left%20side%20is,%E2%80%9D%20%3E%20%E2%80%9CCopy%20styles%E2%80%9D)

- [#3](https://daily-dev-tips.com/posts/chrome-copy-all-css-for-an-element/)



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
