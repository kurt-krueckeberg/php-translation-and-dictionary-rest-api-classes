#  DOM

##  DocumentFragements

[MDN Web Docs: DocumentFragment](https://developer.mozilla.org/en-US/docs/Web/API/DocumentFragment)

The DocumentFragment interface represents a minimal document object that has no parent.

It is used as a lightweight version of Document that stores a segment of a document structure comprised of nodes just
like a standard document. The key difference is due to the fact that the document fragment isn't part of the active document
tree structure. Changes made to the fragment don't affect the document (even on reflow) or incur any performance impact when changes are made.

### Examples

#### PHP examples code using `createDocumentFragment`, `appendXML` and `appendChild`

```php
// Create a new DOM Document
$dom = new DOMDocument('1.0', 'utf-8');
  
// Create a root element
$dom->loadHTML("<body><ul>\n</ul></body>");  

// Create a Fragment
$fragment = $dom->createDocumentFragment();
  
// Append the XML
$fragment->appendXML("<li>one</li>\n<li>two</li>\n");

$ul = $dom->getElementsByTagName('ul')->item(0);
  
// Append the fragment
$ul->appendChild($fragment);
  
echo $dom->saveXML();
```

```php
// Create a new DOM Document
$dom = new DOMDocument('1.0', 'iso-8859-1');
  
// Create a root element
$dom->loadXML("<body>");
  
// Create a Fragment
$fragment = $dom->createDocumentFragment();
  
// Colors
$colors = ['red', 'green', 'blue'];
  
for ($i = 0; $i < 3; $i++) {
    // Append the XML
    $fragment->appendXML(
"<div style='color: $colors[$i]'>This is $colors[$i]</div>");
  
    // Append the fragment
    $dom->documentElement->appendChild($fragment);
}
  
echo $dom->saveXML();
```

#### PHP examples code using `createDocumentFragment`, `createElement`/'createTextNode` and `appendChild`
Alternative to `appendXML()`


```php
// Create a new DOM Document
$dom = new DOMDocument('1.0', 'utf-8');
  
// Create a root element
$dom->loadHTML("<body><ul>\n</ul></body>");  

$fruits = ["Banana", "Orange", "Mango"];

// Create a document fragment:
$frag = $dom->createDocumentFragment();

// Add <li> elements to the fragment:
foreach ($fruits as $fruit) {

  $li = $dom->createElement('li');
  
  // Create text node and 'append' the text node to the li node
  $txt = $dom->createTextNode($fruit);
  
  // $li->textContent = $dom->createTextNode($fruit);
  
  $li->appendChild($txt);
  
  $frag->appendChild($li);
}

$dom->getElementsByTagName('ul')->item(0)->appendChild($li);

echo $dom->saveHTML();
```

## Using `insertBefore` to insert a new first node of parent node

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

```php
$doc = new DOMDocument();

$node1 = $doc->createElement('div');

$node2 = $doc->createElement('div');

$res1 = $doc->appendChild($node1);

$res2 = $doc->insertBefore($node2, $res1);

$res3 = $doc->insertBefore($node1, $node2);

var_dump($doc->saveXML());
```
