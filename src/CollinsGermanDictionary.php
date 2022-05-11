<?php
declare(strict_types=1);
namespace LanguageTools;

class CollinsGermanDictionary extends RestClient implements DictionaryInterface {

    static private array $lookup = array('method' => "GET", 'route' =>"api/v1/dictionaries/german-english/entries");
    static private string $german_dict_code  = "german-english"; 

    private string $accessKey;
    private string $baseUrl;
    private array  $query;

    function __construct($c = new CollinsConfig)
    {
       parent::__construct($c->endpoint);

       foreach($c->headers as $key => $value) 
          
            $this->headers[$key] = $value;
    }

    public function getDictionaryLanguages() : array
    {
         return array("DE", "EN"); // todo ???
    } 


    public function lookup(string $word, string $src="DE", string $target="EN") : array
    {
       /*
          This is wrong. You first need to do API search request. This will return the entryIDs and the headword. For example:,

           endpoint:  https://api.collinsdictionary.com/api/v1
           request: search
           max resulst: 10
           results list page index: 1:w
           {
               "resultNumber": 6,
               "results": [
                   {
                       "entryLabel": "Handeln",
                       "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/handeln_2",
                       "entryId": "handeln_2"
                   },
                   {
                       "entryLabel": "handeln",
                       "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/handeln_1",
                       "entryId": "handeln_1"
                   },
                   {
                       "entryLabel": "abhandeln",
                       "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/abhandeln_1",
                       "entryId": "abhandeln_1"
                   },
                   {
                       "entryLabel": "aushandeln",
                       "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/aushandeln_1",
                       "entryId": "aushandeln_1"
                   },
                   {
                       "entryLabel": "einhandeln",
                       "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/einhandeln_1",
                       "entryId": "einhandeln_1"
                   },
                   {
                       "entryLabel": "herunterhandeln",
                       "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/herunterhandeln_1",
                       "entryId": "herunterhandeln_1"
                   }
               ],
               "dictionaryCode": "german-english",
               "currentPageIndex": 1,
               "pageNumber": 1
           }  
        */

        $route = self::$lookup['route'] . '/' . urlencode($word);

        $this->query['format'] = 'xml'; 

        $contents = $this->request(self::$lookup['method'], $route, ['headers' => $this->headers, 'query' => $this->query]);

        $obj = json_decode($contents, true);
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
