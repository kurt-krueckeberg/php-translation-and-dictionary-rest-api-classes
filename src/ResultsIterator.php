<?php
declare(strict_types=1);
namespace LanguageTools;

class ResultsIterator implements  \SeekableIterator, \ArrayAccess, \Countable {

    private array|\stdClass $results;
    private int $count;
    private int $current;

    // Callable method that is invoked by current() to return
    // current result.
    private $get_result; 
    

    public function __construct(array $results, callable $func)
    {
       $this->results = $results;

       $this->cnt = count($results);

       $this->current = 0; 

       $this->get_result = $func;
    }

    // no-op
    public function offsetSet(mixed $offset, mixed $value) : void
    {
        return; 
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->results[$offset]);
    }

    public function offsetUnset($offset) : void
    {
        return; 
    }

    public function offsetGet($offset) : mixed
    {
        return isset($this->results[$offset]) ? ($this->get_result)( $this->results[$offset] ) : null;
    }
  
    public function count(): int // Countable
    {
        return $this->cnt;
    }

    // SeekableIterator
    public function seek(int $offset) : void 
    {
       if ($offset >= $count || 0 > $offset)
            throw new OutOfBoundsException("offset not in bounds");

       $this->current = $offset;
    }
   
    public function current(): mixed
    {        
        return ($this->get_result)( $this->results[$this->current] );
    }

    public function key(): mixed
    {
         return $this->current;
    }

    public function next(): void
    {
       ++$this->current;
    }
    
    public function rewind(): void
    {
       $this->current = 0; 
    }

    public function valid(): bool
    {
      return ($this->cnt !== $this->current); 
    }
}
