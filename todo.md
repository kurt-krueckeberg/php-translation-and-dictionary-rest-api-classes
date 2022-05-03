- Abandon the Pons aAPI. The Pons API is completely tied to the Pons online dictionary HTML and CSS  utpu.mple, the API response content contains embedded html and CSS (within `<span>`'s), annd there is no description of 
  the most of the fields. Furthermore, there is an implied order and meaning to the response content that is not even documented.

- It is wrong to use `urlencode($input_text)` during `DictionrayInterface::lookup()`. 

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
