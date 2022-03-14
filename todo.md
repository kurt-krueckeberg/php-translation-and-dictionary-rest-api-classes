# TODO

Try to see if I can make the XML entries precisely reflect respective API tranlation specifications; for example, if a query parameter must be fist, capture this in the XML. 

- Better understand how to design XML.
- Understand requirements of each translation service in terms of what is required for each api call. 
- What is common across services, what differs and how?

For example:
<queryString>
  <parm order="first">
    <name>Key</name>
    <value>

- [XML Tutorial](https://www.w3schools.com/xml/)

- See [XPath explanions](xpath-explained.md)

- Azure Translation Implementaqtions in PHP

  - Microsoft's [owm implmentation in PHP](https://github.com/MicrosoftTranslator/Text-Translation-API-V3-PHP/blob/master/Translate.php)

  - [Matthisan Noback's code](https://github.com/matthiasnoback/microsoft-translator)
    - Mainly just the file [Tranlate.php](https://github.com/matthiasnoback/microsoft-translator/blob/master/src/MatthiasNoback/MicrosoftTranslator/ApiCall/Translate.php)

  - [CURL Implementation](https://www.aw6.de/azure/)

- Gernealize the implementation thru interfaces and design patterns like

  - Template Pattern

  - Strategy Pattern

- Decide on a namespace ????/sentence-generate: 

- Make this repositories composer-compliant, so that you can install it using composer and autoload its classes. 

  - [Composer Package Management](https://whoisryosuke.com/blog/2018/how-to-create-a-php-package-for-composer/)
 
  - [Packagist The PHP Package Repository](https://packagist.org/)
