<?php
declare(strict_types=1);
namespace LanguageTools;

interface SentenceFetchInterface  { 
   public function fetch(string $word, int $count=3) : ResultsIterator;
}
