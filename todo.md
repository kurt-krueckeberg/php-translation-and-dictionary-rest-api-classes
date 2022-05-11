## Comparison of Azure vs Systran

When you compare Azure definitions (with examples) to Systran definitions (with expressions), it is obvious the Systran definitions are more extensive. Systran outweighs the example phrases that Azure sometimes
provided for a definition. 

## CSS sytling of definition results: 

- [PONS DE -> EN](https://en.pons.com)

See [doc/pons-html-output.png](doc/pons-html-output.png)

Pons uses <dl>'s -- definition list? -- to markup its table-display of dictionary results. A <dt> is the left colum and a <dl> is the right column.
You can use Chrome's inspector to copy the CSS styles. Just right click, then do  -> Copy CSS Styles.

CSS Grid layout:

[#1](https://stackoverflow.com/questions/44134262/create-a-table-using-definition-list-and-grid-layout)

[#2](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Grid_Layout/Basic_Concepts_of_Grid_Layout)

[#3](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Grid_Layout)

[#4](https://css-tricks.com/snippets/css/complete-guide-grid/)
	

  - [Collins DE -> EN diciionary](https://www.collinsdictionary.com/dictionary/german-english/handeln)

  - [Cambridge DE -> EN](https://dictionary.cambridge.org/dictionary/german-english/handeln?q=Handeln)

See file [dt-styling.md](./dt-styling.md)

See these links on howot:

**Extracting CSS for an element**:

- [#1](https://stackoverflow.com/questions/5296622/how-can-i-grab-all-css-styles-of-an-element)

- [#2](https://getcssscan.com/blog/how-to-inspect-copy-element-css#:~:text=First%2C%20hover%20over%20the%20element,choose%20the%20option%20%E2%80%9CInspect%E2%80%9D.&text=On%20the%20left%20side%20is,%E2%80%9D%20%3E%20%E2%80%9CCopy%20styles%E2%80%9D)

- [#3](https://daily-dev-tips.com/posts/chrome-copy-all-css-for-an-element/)


-  Using `urlencode($input_text)` during `DictionrayInterface::lookup()` causes failure. 

- Create PonsResultsIterator. See the comments in `PonsDictionary::lookup()` on how to do this.

- Implement a `check_iso_code(string $lang) : bool`

  1. classes implementing from DictionaryInterface
  2. classes implementing from TranslateInterface

- Chankge composer.json so that

  - it is a github respoistory-backed composer package.

  - autolaoding is generated automatically

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)
