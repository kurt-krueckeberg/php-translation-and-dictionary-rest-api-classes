#  DOM

##  DocumentFragements

[MDN Web Docs: DocumentFragment](https://developer.mozilla.org/en-US/docs/Web/API/DocumentFragment)

The DocumentFragment interface represents a minimal document object that has no parent.

It is used as a lightweight version of Document that stores a segment of a document structure comprised of nodes just
like a standard document. The key difference is due to the fact that the document fragment isn't part of the active document
tree structure. Changes made to the fragment don't affect the document (even on reflow) or incur any performance impact when changes are made.

Javascript Example:

```javascript
const element  = document.getElementById('ul'); // assuming ul exists

const fragment = document.createDocumentFragment();

const browsers = ['Firefox', 'Chrome', 'Opera', 'Safari', 'Internet Explorer'];

browsers.forEach(function(browser) {

    const li = document.createElement('li');

    li.textContent = browser;

    fragment.appendChild(li);
});

element.appendChild(fragment);
```

- [PHP DomDocument::createDocumentFragment Examples](https://hotexamples.com/examples/-/DomDocument/createDocumentFragment/php-domdocument-createdocumentfragment-method-examples.html)

- [PHP | DOMDocument::createDocumentFragment Function](https://www.geeksforgeeks.org/php-domdocument-createdocumentfragment-function/)


PHP Examples

```php
<?php
  
// Create a new DOM Document
$dom = new DOMDocument('1.0', 'iso-8859-1');
  
// Create a root element
$dom->loadXML("<root/>");
  
// Create a Fragment
$fragment = $dom->createDocumentFragment();
  
// Append the XML
$fragment->appendXML(
    "<h1>Heading 1</h1><h2>Heading 2</h2><h3>Heading 3</h3>");
  
// Append the fragment
$dom->documentElement->appendChild($fragment);
  
echo $dom->saveXML();
```

Output?


```php
$dom = new \DOMDocument();

$body = $dom->appendChild($dom->createElement('body'));

$fragment = $dom->createDocumentFragment();

$fragment->appendXml('<p>first</p>second');

$body->appendChild($fragment);

echo $dom->saveHtml();
```

Output:

```html
<body><p>first</p>second</body>
```

## Use `insertBefore` to insert a new first node of parent node

```php
$body = $doc->getElementsByTagName('body')->item(0);

$newNode = $doc->createElement('section');

$body->insertBefore($newNode, $body->firstChild);

echo $dom->saveHtml();
```


## Use `appendChild` to append a new child node

```php
$body = $doc->getElementsByTagName('ul')->item(0); // or do xpath query

$li = $doc->createElement('li');

$body->insertBefore($li, $body->firstChild);

echo $dom->saveHtml();
```


