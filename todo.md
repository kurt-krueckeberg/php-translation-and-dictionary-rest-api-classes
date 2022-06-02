#  Todo

The CollinsGermanDictionary sucessfully will return best matching content. But it contains embedded html with style information. While the style information can theoretically be scrapped from the collins website. An entry
can return information on several topics. These topics are not documented and therefore the correpsonding CSS peculiar to them is unkown. Itseems like a lot of emprical trial and error would be need to get all the CSS we would need.

## Comparison of Azure vs Systran

Systran is to be preferred ove Azure. When you compare Azure definitions (with its examples) to the Systran definitions (with its expressions), it is obvious the Systran definitions are more extensive. Systran outweighs the example phrases that Azure
sometimes provides for a definition. 

## Style the definition results: 

How to Use CSS Grid layout:

[#2](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Grid_Layout/Basic_Concepts_of_Grid_Layout)

[#3](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Grid_Layout)

[#4](https://css-tricks.com/snippets/css/complete-guide-grid/)
	
See file [dt-styling.md](./dt-styling.md)

See these links on howto extragin CSS:

**Extracting CSS for an element**:

- [#1](https://stackoverflow.com/questions/5296622/how-can-i-grab-all-css-styles-of-an-element)

- [#2](https://getcssscan.com/blog/how-to-inspect-copy-element-css#:~:text=First%2C%20hover%20over%20the%20element,choose%20the%20option%20%E2%80%9CInspect%E2%80%9D.&text=On%20the%20left%20side%20is,%E2%80%9D%20%3E%20%E2%80%9CCopy%20styles%E2%80%9D)

- [#3](https://daily-dev-tips.com/posts/chrome-copy-all-css-for-an-element/)


- Have drived classes implement `check_iso_code(string $lang) : bool`  which can be made abstract in RestClient.

  1. classes implementing from DictionaryInterface
  2. classes implementing from TranslateInterface

- Chankge composer.json so that

  - it is a github respoistory-backed composer package.

  - autolaoding is generated automatically

See these articles:

- [composer: How to Use Git Repositories](https://www.daggerhartlab.com/composer-how-to-use-git-repositories/)
