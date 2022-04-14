<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Collections;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;
use stdClass;
use Traversable;

class Collection implements ArrayAccess, JsonSerializable, IteratorAggregate
{
    protected $items;

    public function __construct($items)
    {
        $this->items = gettype($items) === 'array'  ? $items : [$items];
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    public function jsonSerialize()
    {
        return $this->array;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this);
    }

    public function get()
    {
        return $this->items;
    }

    public function first(): stdClass
    {
        $item = new stdClass();
        foreach ($this->items as $key => $value) {
            $item->$key = $value;
        }
        return $item;
    }
}
