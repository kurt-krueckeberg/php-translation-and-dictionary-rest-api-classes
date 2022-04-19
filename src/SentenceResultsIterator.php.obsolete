<?php
declare(strict_types=1);
namespace LanguageTools;

class SentenceResultsIterator extends ResultsIteratorBase { 
 
    public function __construct(array $objs)
    {
       parent::__construct($objs); 
    }

    protected function get_member(mixed $current) : mixed
    {
        return $current->sentence;
    }
}
