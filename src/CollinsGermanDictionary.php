<?php
declare(strict_types=1);
namespace LanguageTools;

/*
  Test. Then convert to Guzzle.
 */

class CollinsGermanDictionary extends RestApi implements DictionaryInterface {

    static private $route = "api/v1/dictionaries/german-english/entries";

    private string $accessKey;
    private string $baseUrl;
    private array  $query;

    function private make_route(string $word)
    {
 
    function __construct($c = new CollinsConfig)
    {
       parent::__construct($c->endpoint);

       foreach($c->headers as $key => $value) 
          
            $this->headers[$key] = $value;
    }

    /*
        $format is xml or html -- or is the documentation wrong, and this should be json or xml?
          Q: Is format even required?
     */ 
    //public function getEntry($dictionaryCode, string $entryId, $format)  : mixed
    public function lookup(string $word)  : mixed
    {
        $route = self::$route . urlencode($word);

        // query paramters
        /* Is  reallyformat neeeded????
 
        if ($format) { // Original code
            if (!$this->isValidEntryFormat($format))
                return null;
         */
        //$this->query['format'] = $format;

        $contents = $this->request(self::$entry['method'], $route, ['headers' => $this->headers]);

        $obj = json_decode($contents);
        return $obj;
    }
/*
    public function getEntryPronunciations($dictionaryCode, $entryId, $lang = null) : mixed 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';

        $uri .= urlencode($entryId);

        $uri .= '/pronunciations';

        $c = '?';

        if ($lang) {
            if (!$this->isValidEntryLang($lang))
                return null;

            $uri .= $c.'lang='.$lang;

            $c = '&';

        }
        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;
    }

    public function getNearbyEntries($dictionaryCode, $entryId, $entryNumber = null) 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';

        $uri .= urlencode($entryId);

        $uri .= '/nearbyentries';

        $c = '?';

        if ($entryNumber) {
            $uri .= $c.'entrynumber='.$entryNumber;

            $c = '&';

        }
        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;

    }

    public function getRelatedEntries($dictionaryCode, $entryId) 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';

        $uri .= urlencode($entryId);

        $uri .= '/relatedentries';

        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;

    }

    public function getThesaurusList($dictionaryCode) 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/topics/';

        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;

    }

    public function getTopic($dictionaryCode, $thesName, $topicId) 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/topics/';

        $uri .= urlencode($thesName);

        $uri .= '/';

        $uri .= urlencode($topicId);

        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;

    }
    private function isValidDictionaryCode($code)
     {

        if (strlen($code) < 1)
            return false;

        for($i = 0; $i < strlen($code); ++$i) {

            $c = substr($code, $i, 1);

            // Make sure no param are injected
            if ($c == '/' || $c == '%')
                return false;

            if ($c == '*' || $c == '$')
                return false;

        }
        return true;

    }

    private function isValidEntryFormat($format) 
    {
        for($i = 0; $i < strlen($format); ++$i) {

            $c = substr($format, $i, 1);

            # Make sure no param are injected
            if ($c == '/' || $c == '%')
                return false;

        }
        return true;

    }

    private function isValidEntryLang($lang) 
    {
        for($i = 0; $i < strlen($lang); ++$i) {

            $c = substr($lang, $i, 1);

            # Make sure no param are injected
            if ($c == '/' || $c == '%')
                return false;

        }
        return true;

    }

    private function isValidWotdDay($day) 
    {
        for($i = 0; $i < strlen($day); ++$i) {

            $c = substr($day, $i, 1);

            # Make sure no param are injected
            if ($c == '/' || $c == '%')
                return false;

        }
        return true;

    }
*/
}
