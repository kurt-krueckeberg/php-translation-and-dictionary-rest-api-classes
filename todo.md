#  Todo

Correct the formatting for HtmlBuilder. Can I use tidy without screwing up the nested <ul> s that has the definitions?
The PriorHtmlBuildr properly creates the output (see good.htl), but HtmlBuilder doesn't (see bad.html). The htnl is wrong somewhere.


Maybe work on top and ottom margsin between <ul> with word and part-of-speech and surrounding elements.

There are at least three solutions to prevent displaying discs for the <dd class="expressions"> that has the nested definitinos list of expressions:

See the two examples: [ex1.html](dl-test/ex1.html) and [ex2.html](dl-test/ex2.html) in [dl-test/](dl-test/)

- And maybe correctin margins (or padding).

## Adjusting `<dl>` margins 

To adjust margins for <dl>, <dt> and <dd, see the W3schools try me:

1. [<dl> Try Me](https://www.w3schools.com/TAGS/tag_dl.asp)
2. [<dt> Try Me](https://www.w3schools.com/TAGS/tag_dt.asp)
3. [<dd> Try Me](https://www.w3schools.com/TAGS/tag_dd.asp)

This is a great html/css [Testing Site](https://way2tutorial.com/css/snippet_editor/?file=descendant_selector)


CSS Grid:

- [Mozilla Developer: Using Mutlti-Column Layouts](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Columns/Using_multi-column_layouts)

- [Grid Explanied](https://www.w3schools.com/css/css_grid.asp)

- CSS [column properties](https://www.w3schools.com/Css/css3_multiple_columns.asp)

## Grid and Overflow

- [How to solve a CSS grid overflow](https://datacadamia.com/web/css/grid/overflow)

## Styling deinition lists (includes using grid)

[CSS: Formatting a Definition List](https://www.the-art-of-web.com/css/format-dl/)

``html
<!DOCTYPE html>
<html>
<head>
 <title>dt.html</title>
 <meta charset="UTF-8">
<style>
dl {
  display: grid;
  grid-template: auto / 200px 1fr;
}
dt, dd {
  margin: 0;
}
dt {
  background-color: #eee;
}
dd {
  background-color: #ddd;
}
</style>
</head>
   <body>
     <div>
        <dl>
	   <dt>term</dt>
	   <dd>description</dd>
	   <dt>term</dt>
	   <dd>description</dd>
	   <dt>term</dt>
	   <dd>description</dd>
       </dl>
     </div>
 </body>
</html>
```
2. Add to SystrandCitResult `other_expressions`, which is in `$match->source->other_expressions`. It is an array of stdClass objects (with propertires of 'source' and 'destination').

## Definition Lists

[Definition Lists](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dl)

A definition lists may also contain a order- or unorder-list as below, which is a definition list that contains an unordered list (the ingredients) and an ordered list (the procedure):

```html
<dl>
<dt><strong>The ingredients:</strong></dt>

<dd>
<ul>
<li>100 g. flour</li>

<li>10 g. sugar</li>

<li>1 cup water</li>

<li>2 eggs</li>

<li>salt, pepper</li>
</ul>
</dd>

<dt><strong>The procedure:</strong></dt>

<dd>
<ol>
<li>Mix dry ingredients thoroughly.</li>

<li>Pour in wet ingredients.</li>

<li>Mix for 10 minutes.</li>

<li>Bake for one hour at 300 degrees.</li>
</ol>
</dd>

<dt><strong>Notes:</strong></dt>

<dd>The recipe may be improved by adding raisins.</dd>
</dl>
```

NOTE: A <dd> can apparently contain a nested deinition list: 

```html
<dd>
  <dl>
    <dt>...</dt>
    <dd>...</dd>
  </dl>
</dd>

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
