- Abandon the Pons aAPI. The Pons API is completely tied to the Pons online dictionary HTML and CSS  utpu.mple, the API response content contains embedded html and CSS (within `<span>`'s), annd there is no description of 
  the most of the fields. Furthermore, there is an implied order and meaning to the response content that is not even documented.

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
