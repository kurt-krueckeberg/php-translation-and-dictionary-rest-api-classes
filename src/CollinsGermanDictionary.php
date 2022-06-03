<?php
declare(strict_types=1);
namespace LanguageTools;
use LanguageTools\ClassID;

class CollinsGermanDictionary extends RestClient {

   public function __construct()
   {   
       parent::__construct(ClassID::Collins);
   } 

   static public function get_css() : string
   {
      return CollinsCss::get_css();
   }
   
   /* Returns an array whose elements have these properties:

     a. dictionaryCode - the code of the dictionary
     b. dictionaryName - the user-friendly name of the dictionary
     c. dictionaryUrl - the URL of the dictionary's browse list.
   */
    public function getDictionaryLanguages() : array
    {
        static $method = 'GET';
        static $route  = "api/v1/dictionaries";
        
        $json = $this->request($method, $route);
         
        $objs = json_decode($json);
         
        return $objs;             
    } 
    
    /*

      
     Input: word to search. 
     Output: All words in the dictionary that contain the string along with their entryId. To get an actual definition, you must pass the entryId to
     get_entry(string $entryId).

     Results Returns all words in the dictionary that contain the string. For example, searching for 'Handeln' returns this Json object of six results:
      
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
    public function search($word, int $pageSize=10, int $pageIndex=1) : \stdClass
    {
        static $method  ="GET";
        static $route = 'api/v1/dictionaries/german-english/search';
        static $search ='q';
        static $pagesize = 'pagesize';
        static $pageindex = 'pageindex';

        $this->query[$search] = $word; 
        $this->query[$pagesize] = $pageSize; 
        $this->query[$pageindex] = $pageIndex; 

        $contents = $this->request($method, $route, ['query' => $this->query]);

        $obj = json_decode($contents);
      
        return $obj;
    } 

    public function get_entry(string $entryId) : \stdClass | null
    {
        static $method = "GET";                         
        static $route  = "api/v1/dictionaries/german-english/entries/";
        static $format = 'HTML';

        $query = array();
        $query['format'] = $format;
        
        $route .= $entryId;  // The entryId is appened to the route.
  
        try {
            
           $json = $this->request($method, $route, ['query' => $query]);       
           
           
        } catch (\Exception $e) {
            
            return null;
        }

        return json_decode($json);        
    }

     /*
        Gets the first/best matching entry
               
        API call = `/api/v1/dictionaries/{dictionaryCode}/search/first/?q={searchWord}&format={format}`
              
        Input:
          
          1. dictionaryCode - the dictionary code
                
          2. searchWord - the word we are searching for
               
          3. format - the format of the entry, either "html" or "xml" [optional; default = html]
               
        Output JSON object properties:
               
             1. dictionaryCode
             
             2. format
             
             3. entryContent
             
             4. entryId - the id of the entry
             
             5. entryLabel - the label of the entry (headword)
             
             6. entryUrl - the direct url to this entry on the main website
             
             7. topics - an array containing the topics linked to the entry (if any):
             
                - topicId - the id of the topic
                
                - topicLabel - the label of the topic
                
                - topicUrl - the direct url to the topic page on the main
       
     */
    public function get_best_matching(string $word) : \stdClass | null
    {
        static $method = "GET";                         
        static $route  = "api/v1/dictionaries/german-english/search/first/";
        static $format = 'html';

        $query = array();
        $query['format'] = $format;
        $query['q'] = $word;
  
        // If a word if not found in the dictionary, an exception is thrown and  $e->getCode is typically equal to 404.
        try {
            
           $json = $this->request($method, $route, ['query' => $query]);       
           
        } catch (\Exception $e) {
            
            return null;
        }

        $obj = json_decode($json);

        return $obj->entryContent;
    }

    public function get_did_you_mean(string $word) : array 
    {
        static $method = "GET";                         
        static $route  = "api/v1/dictionaries/german-english/didyoumean/";

        $query = array();
        $query['q'] = $word;
  
        // If a word if not found in the dictionary, an exception is thrown and  $e->getCode is typically equal to 404.
            
        $json = $this->request($method, $route, ['query' => $query]);       
           
        $obj = json_decode($json);

        return $obj->suggestions;
    }

}
