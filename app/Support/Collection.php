<?php

namespace App\Support;

use ArrayIterator;
use IteratorAggregate;

class Collection implements IteratorAggregate
{
    protected $items = [];
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function countItems()
    {
        return count($this->items);
    }


    public function add(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }

    public function merge(Collection $collection)
    {
        return $this->add($collection->getItems());
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function toJson()
    {
        return json_encode($this->items);
    }
}
