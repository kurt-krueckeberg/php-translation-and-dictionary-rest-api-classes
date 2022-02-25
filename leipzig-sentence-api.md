# REST API of the Leipzig Corpora Collection / Projekt Deutscher Wortschatz

## What is RESTful API

  The IBM Developers article [Introduction to RESTful Web Services](https://developer.ibm.com/articles/ws-restful/) is very succinct and clear. It explains how the POST, GET, UPDATE and DELETE HTTP calls should be used in a RESTfu-designed Web Service. It explains the stateless nature of the client requests and server responses in a
  RESTful Web Service. It explains the use of unique resource identifiers and what a "resource" is in a REST-designed Web Service.
- 
- RESTFul [Web Services](https://sentai.eu/info/restful-web-services/?print=print) 
 
  This is a PHP perspective on REST--I tink.

- What is [JSON](https://www.w3schools.com/js/js_json_intro.asp) introduction from W3Schoools.

The **base_url** = `http://api.corpora.uni-leipzig.de/ws`

## Getting Sample Sentences


The **HTTP GET** request: `http://api.corpora.uni-leipzig.de/ws/sentences/{corpusName}/sentences/{word}`. In a RESTful Web Service GET always is a request for resources from the server. It should never be used to update server resources. That is the roll of POST.

Example using curl

```bash
curl -X GET "http://api.corpora.uni-leipzig.de/ws/sentences/deu_news_2012_1M/sentences/Zucker?offset=0&limit=10" -H  "accept: application/json"
```
