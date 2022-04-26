- WebPageCreatr currently creates its own file name that is quite long. Maybe shortened it somehow.. 

- Add plantuml to documentation using the PhUML tool that I have bookmarked. It seems very good.

- Implement a `check_iso_code(string $lnag) : bool` in a IsoCodes trait (or in a base class):

  1. classes implementing from DictionaryInterface
  2. classes implementing from TranslateInterface

- Implement SystransTranslator after getting a trial 

- Chankge composer.json so that

  - it is a github respoistory-backed composer package.

  - autolaoding is generated automatically

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)
