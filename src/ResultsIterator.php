<?php
declare(strict_types=1);
namespace LanguageTools;

abstract class ResultsIterator implements  \SeekableIterator, \ArrayAccess, \Countable {

    private array $objs;
    private int $count;
    private int $current;

    public function __construct(array $objs)
    {
       $this->objs = $objs;
       $this->cnt = count($objs);
       $this->current = 0; 
    }

    abstract protected function get_result(mixed $match) : string | \stdClass;

    // no-op todo: throw an execption
    public function offsetSet(mixed $offset, mixed $value) : void
    {
        return; 
    }

    // no-op todo: throw an execption
    public function offsetExists($offset) : bool
    {
        return isset($this->objs[$offset]);
    }

    public function offsetUnset($offset) : void
    {
        return; 
    }

    public function offsetGet($offset) : mixed
    {
        return isset($this->objs[$offset]) ? $this->get_result( $this->objs[$offset] ) : null;
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
        return $this->get_result( $this->objs[$this->current] );
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
