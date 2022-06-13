#  Todo

We we trz to appendChild)= the fragement of results for 'veräadern', which is this

```html
<div class="defn"><h1 class="hwd">verändern
</h1><h2 class='pos'>[ verb ]
</h2>
<ul class="definitions"><li>to change
</li><ul class='expressions'>
<li>verändern mein Leben - to change my life
</li><li>wesentlich verändern - to change significantly
</li><li>verändern mein Leben ganz und gar - to utterly change my life
</li><li>verändern die Anreize für Politiker - to change the politicians' incentives
</li>
</ul><li>to alter
</li><li>to modify
</li><li>to transform
</li><li>to amend
</li><li>to shift
</li><li>to evolve
</li>
</ul>sich verändern             <----- This is an entirely new "word" and defintion. IT should have an <h1> -- maybe <div ...><h1>...</h1>
</h1><h2 class='pos'>[ verb ]
</h2>
<ul class="definitions"><li>to change
</li><ul class='expressions'>
<li>dramatisch sich verändern - to change dramatically
</li><li>erheblich sich verändern - to change significantly
</li><li>radikal sich verändern - to change radically
</li><li>sehr sich verändern - to change a great deal
</li>
</ul><li>to alter
</li><li>to transform
</li><li>to shift
</li>
</ul>
</div>
```
We get this error:

PHP Warning:  DOMDocumentFragment::appendXML(): Entity: line 3: parser error : Opening and ending tag mismatch: div line 1 and h1 in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML(): li><li>to amend</li><li>to shift</li><li>to evolve</li></ul>sich verändern</h1> in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML():                                                                                ^ in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML(): Entity: line 5: parser error : chunk is not well balanced in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML(): great deal</li></ul><li>to alter</li><li>to transform</li><li>to shift</li></ul> in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML():                                                                                ^ in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML(): Entity: line 5: parser error : chunk is not well balanced in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML(): great deal</li></ul><li>to alter</li><li>to transform</li><li>to shift</li></ul> in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41
PHP Warning:  DOMDocumentFragment::appendXML():                                                                                ^ in /home/kurt/php-translation-and-dictionary-rest-api-classes/src/HtmlBuilder.php on line 41

because 'sich verändern' is a new rod. See how Collins handles this and Pons. Ceate the html accordingly.
 

[DOM Tutorial](https://www.w3schools.com/xml/dom_intro.asp)

[PHP DOM Tutorial](https://www.bitdegree.org/learn/php-domdocument)

PHP [XPath Examples](https://www.bitbook.io/domdocument-php-tutorial)

PHP [DOMDocument Examples](https://eecs.blog/php-using-domdocument-to-work-with-html/)

PHP [DOMDocument::createTextNode](https://www.php.net/manual/en/domdocument.createtextnode.php)
o
Q: Try using `createelement`. Can it be used with a fragement?

Definition Lists

[Definition Lists](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dl)

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
