Documenation is in readme.html. It may also be generated from the doc-read.me, which is in pandoc-flavored markdown, by

- Installing pandoc

```bash

$ pandoc doc-readme.md -c screen.css -t html -s -o readme.html
