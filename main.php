<?php

include "SentenceFetcher.php";

   // TODO: IS a timeout required per request?
   $s = new SentenceFetcher('deu_news_2012_1M');
   $result = $s->get('Zucker');
   var_dump( $result  );
