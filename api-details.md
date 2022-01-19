# REST API of the Leipzig Corpora Collection / Projekt Deutscher Wortschatz

## What is RESTful API

- IBM Developers [Introduction to RESTful Web Services](https://developer.ibm.com/articles/ws-restful/)
- RESTFul [Web Services](https://sentai.eu/info/restful-web-services/?print=print)
- What is [JSON](https://www.w3schools.com/js/js_json_intro.asp)

The **base_url** = `http://api.corpora.uni-leipzig.de/ws`

## Getting Sample Sentences

Issue **HTTP GET** request: `http://api.corpora.uni-leipzig.de/ws/sentences/{corpusName}/sentences/{word}`

Example using curl

```bash
curl -X GET "http://api.corpora.uni-leipzig.de/ws/sentences/deu_news_2012_1M/sentences/Zucker?offset=0&limit=10" -H  "accept: application/json"
```
