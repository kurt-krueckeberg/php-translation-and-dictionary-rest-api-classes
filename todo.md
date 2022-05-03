- The Pons API is not really adequately documented. The API is tied to the Pons online dictionary output. In particular, it is tied to the html and CSS used on by the Pons online dictionaries.

   And the API response content not only contains embedded html and CSS (within `<span>`'s) but other undocumented information like which `rom` contains the definitions and which `rom`'s contain example

   phrases. It is impossible to really use the API apart from the Pons HTML and CSS. In effect, you have to reverse engineer their online dictionary using an inadequately documented API. Too bad!

Emperically figure out what each field means by comparing it to the output of 'Haus'.

- Compare the `print_r()` output of SystranResultsIterator in doc/systran-output with an actual dictionary definition, say, from (no kidding) that displayed by https://en.pons.com. 

- Create PonsResultsIterator that does what SystranResultsIterator does: provide a `get_current(mixed $current)` method to return the truly relevant fields. To determine which fields are most important, do
  print-screens of the defintion output for the words in short-list.txt.

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
