<?php
declare(strict_types=1);
namespace LanguageTools;
use LanguageTools\ClassID;

class NewCollinsDictionary extends RestClient implements DictionaryInterface {

    static private array $lookup = array('method' => "GET", 'route' => "api/v1/dictionaries/german-english/entries");

/*
Search
REST request = /api/v1/dictionaries/{dictionaryCode}/search/?q={searchWord}&pagesize={pageSize}&pageindex={pa
geIndex}
*/

    static private array $search = array('method' => "GET", 'route' => "api/v1/dictionaries/german-english/search");

    static private string $german_dict_code  = "german-english"; 

    private string $accessKey;
    private string $baseUrl;
    private array  $query;

   public function __construct()
   {   
       parent::__construct(ClassID::Collins);
   } 

    public function getDictionaryLanguages() : array
    {
         return array("DE", "EN"); // todo ???
    } 

    private function search($word, int $pageSize=10, int $pageIndex=1) : string | null
    {
    static $search = array('method' => "GET", 'route' => "api/v1/dictionaries/german-english/search");
    static $qs_search = 'q';
    static $qs_pagesize = 'pagesize';
    static $qs_pageindex = 'pageindex';


        $this->query[$qs_search] = $word; // urlencode(??)
        $this->query[$qs_pagesize] = $pageSize; 
        $this->query[$qs_pageindex] = $pageIndex; 

        $contents = $this->request($search['method'], self::$search['route'], ['query' => $this->query]);

        $obj = json_decode($contents);

        foreach($obj->results as $result) 

            if ($result->entryLabel == $word) return $result->entryId;

        return null; 
    } 

    /*
     * Unfortunetly, the Collins API returns html results that contains CSS styles that are used (but not documented) on the Collins dictionary results webpage.
     *
     */

    public function lookup(string $word, string $src="DE", string $target="EN") : array
    {
    static $qs_format = 'format';
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

        $entryId = $this->search($word);
 
        if (is_null($entryId)) return array(); // no definitions

        $route = self::$lookup["route"] . '/' . urlencode($entryId);

        $this->query[$qs_format] = 'html'; 

        $contents = $this->request(self::$lookup['method'], $route, ['query' => $this->query]);

        $obj = json_decode($contents, true);

        return $obj;
    }
}
