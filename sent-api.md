# REST API of the Leipzig Corpora Collection / Projekt Deutscher Wortschatz

## What is RESTful API

- What is REST API [18 minutes video](https://www.youtube.com/watch?v=Q-BpqyOT3a8)
- Explanation of REST [dedeciated site](https://restfulapi.net/)
- From site above [JSON Explanation](https://restfulapi.net/introduction-to-json/)

The **base_url** = `http://api.corpora.uni-leipzig.de/ws`

## Getting Sample Sentences

Issue **HTTP GET** request: `http://api.corpora.uni-leipzig.de/ws/sentences/{corpusName}/sentences/{word}`

Example using curl

```bash
curl -X GET "http://api.corpora.uni-leipzig.de/ws/sentences/deu_news_2012_1M/sentences/Zucker?offset=0&limit=10" -H  "accept: application/json"
```
