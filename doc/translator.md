## Translator class

The private member vartiables of `Translator` are set in `fetchAPISettings(\SimpleXMLElement $provider)` called by the constructor. The table below
shows how the XML elements correspond to the class variables

|Member Variable       |SimpleXMLElement                                                             |
|----------------------|-----------------------------------------------------------------------------|
|`private $route`      |`$provider->services->service->translation->route`                           |
|`private $method`     |`$provider->services->service->translation->method`                          |
|`private $from_key`   |`$provider->services->service->translation->query->from['source_lang']`      |
|`private $to_key`     |`$provider->services->service->translation->query->from['source_lang']`      |
|`private $bJsonInput` |`$provider->services->service->translation->input == 'json' ? true : false`  |
