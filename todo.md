- Compare `print_r()` output -- once the Pons- and SystranResultsIterator's are working -- with the actual displayed output of defintions on their respective websites.

  Maybe...create a `Definition` class. See ~/r/src/Definition

- It is wrong to use `urlencode($input_text)` during `PonsDictionray::lookup()`. 

- Create PonsResultsIterator. See the comments in `PonsDictionary::lookup()` on how to do this.

- Implement a `check_iso_code(string $lnag) : bool` in a IsoCodes trait (or in a base class):

  1. classes implementing from DictionaryInterface
  2. classes implementing from TranslateInterface

- Implement SystransTranslator after getting a trial 

- Chankge composer.json so that

  - it is a github respoistory-backed composer package.

  - autolaoding is generated automatically

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)
