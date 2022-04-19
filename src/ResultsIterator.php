<?php
declare(strict_types=1);
namespace LanguageTools;

class ResultsIterator implements  \SeekableIterator, \ArrayAccess, \Countable {

    private array $objs;
    private int $cnt;
    private int $current;
    private $f; 

    public function __construct(array $objs, callable $func) 
    {
       $this->objs = $objs;
       $this->cnt = count($objs);
       $this->current = 0; 
       $this->f = $func;
    }

    public function offsetSet($offset, $value) : void
    {
        if (is_null($offset)) {

            $this->objs[] = $value;

        } else {

            $this->objs[$offset] = $value;
        }
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->objs[$offset]);
    }

    public function offsetUnset($offset) : void
    {
        unset($this->objs[$offset]);
    }

    public function offsetGet($offset) : mixed
    {
        return isset($this->objs[$offset]) ? ($this->f)($this->objs[$offset]) : null;
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
        return ($this->f)($this->objs[$this->current]);
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
