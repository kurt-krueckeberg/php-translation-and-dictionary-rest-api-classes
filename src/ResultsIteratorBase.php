<?php
declare(strict_types=1);
namespace LanguageTools;

/*
  Overriden when only the current(0 method needs to retrun part of an object (within an array of results)
 */
abstract class ResultsIteratorBase extends \ArrayIterator { /* SeekableIterator, ArrayAccess, Countable {*/

    private array $ojbs;
    private int $cnt;
    private int $current;

    public function __construct(array $objs, callable $callback) 
    {
       $this->objs = $objs;
       $this->cnt = count($objs);
       $this->current = 0; 
    }

    public function serialize() : string
    {
        return serialize($this->objs); 
    }

    public function unserialize(string $data) : void
    {
        unserialize($this->objs); 
    }

    public function offsetSet($offset, $value) : void
    {
        if (is_null($offset)) {

            $this->container[] = $value;

        } else {

            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) : void
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) : mixed
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
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
   
    // overriden by derivec classes
    abstract protected function get_current(mixed $current) : mixed; 

    public function current(): mixed
    {
        return $this->get_current($this->current);
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


