<?php
declare(strict_types=1);
namespace LanguageTools;

interface CollinsRequestHandler {

    public function prepareGetRequest($curl, $uri, &$headers);
}
