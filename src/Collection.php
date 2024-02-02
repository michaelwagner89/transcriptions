<?php

namespace Laracasts\Transcriptions;

class Collection implements \Countable, \IteratorAggregate, \ArrayAccess, \JsonSerializable {

    public function __construct(protected array $items) {
    }

    public function offsetUnset(mixed $key) {
        unset($this->items[$key]);
    }

    public function offsetGet(mixed $key) {
        return $this->items[$key];
    }

    public function offsetExists(mixed $key) {
        return isset($this->items[$key]);
    }

    #[\Override] public function getIterator() {
        return new \ArrayIterator($this->items);
    }

    public function offsetSet(mixed $key, mixed $value) {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    #[\Override] public function count(): int {
        return count($this->items);
    }

    public function jsonSerialize() {
        return $this->items;
    }
}