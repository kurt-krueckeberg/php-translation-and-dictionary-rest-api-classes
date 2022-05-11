<?php
declare(strict_types=1);
namespace LanguageTools;

/*
  Test. Then convert to Guzzle.
 */

class CollinsDictionary extends RestApi implements DictionaryInterface {

    static private array $dictionaries = array('method' => 'GET', 'route' => 'dictionaries'); 

    function __construct($c
    {
       parent::__construct($c->endpoint);

       foreach($c->headers as $key => $value) 
          
            $this->headers[$key] = $value;
    }


    public function getDictionaries() : array // todo: change later?
    {

       $contents = $this->request(self::$dictionaries['method'], self::$dictionaries['route'],  ['headers' => $this->headers, 'query' => $this->query]);
             
       return json_decode($contents, true);    
    }

    public function getDictionary($dictionaryCode) : mixed // todo: return actual value later 
    {
        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $curl = $this->prepareGetRequest($this->baseUrl."dictionaries/".$dictionaryCode);

        $response = curl_exec($curl);

        return $response;

    }

    public function getEntry($dictionaryCode, $entryId, $format)  : mixed
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';

        $uri .= urlencode($entryId);

        $c = '?';

        if ($format) {
            if (!$this->isValidEntryFormat($format))
                return null;

            $uri .= $c.'format='.$format;

            $c = '&';

        }
        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;
    }

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

    public function search($dictionaryCode, $searchWord, $pageSize = null, $pageIndex = null) 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/search?q=';

        $uri .= urlencode($searchWord);

        $c = '&';

        if ($pageSize) {

            $uri .= $c.'pagesize='.$pageSize;

            $c = '&';

        }
        if ($pageIndex) {
            $uri .= $c.'pageindex='.$pageIndex;

            $c = '&';

        }
        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;

    }

    public function searchFirst($dictionaryCode, $searchWord, $format = null) 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/search/first?q=';

        $uri .= urlencode($searchWord);

        $c = '&';

        if ($format) {
            if (!$this->isValidEntryFormat($format))
                return null;

            $uri .= $c.'format='.$format;

            $c = '&';
        }

        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;

    }

    public function didYouMean($dictionaryCode, $searchWord, $entryNumber = null) 
    {
        $uri = $this->baseUrl;

        if (!$this->isValidDictionaryCode($dictionaryCode))
            return null;

        $uri .= 'dictionaries/'.$dictionaryCode.'/search/didyoumean?q=';

        $uri .= urlencode($searchWord);

        $c = '&';

        if ($entryNumber) {
            $uri .= $c.'entrynumber='.$entryNumber;

            $c = '&';

        }
        $curl = $this->prepareGetRequest($uri);

        $response = curl_exec($curl);

        return $response;

    }
}
