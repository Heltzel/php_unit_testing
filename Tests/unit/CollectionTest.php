<?php

namespace App\Tests\Unit;

use ArrayIterator;
use IteratorAggregate;

class CollectionTest extends \PHPUnit\Framework\TestCase
{

    public function testEmptyInstantiatedCollectionReturnsNoItems()
    {
        $collection = new \App\Support\Collection;
        $this->assertEmpty($collection->getItems());
    }

    public function testCountIsCorrectForItemsPassedIn()
    {
        $collection = new \App\Support\Collection(['one', 'two', 'three']);
        $this->assertEquals(3, $collection->countItems());
    }

    public function testItemsReturnedMatchItemsPassedIn()
    {
        $collection = new \App\Support\Collection(['one', 'two', 'three']);
        $this->assertCount(3, $collection->getItems());
        $this->assertEquals($collection->getItems()[0], 'one');
    }


    public function testCollectionIsInstanceOfIteratorAggregator()
    {
        $collection = new \App\Support\Collection();
        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    public function testCollectionCanBeIterated()
    {
        $collection = new \App\Support\Collection(['one', 'two', 'three']);

        $items = [];
        foreach ($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }


    public function testCollectionCanBeMergedWithOtherCollection()
    {
        $collection1 = new \App\Support\Collection(['one', 'two']);
        $collection2 = new \App\Support\Collection(['three', 'four', 'five']);

        $collection1->merge($collection2);

        $this->assertCount(5, $collection1->getItems());
    }

    public function testCanAddToExistingCollection()
    {
        $collection = new \App\Support\Collection(['one', 'two']);
        $collection->add(['three']);

        $this->assertCount(3, $collection->getItems());
    }


    public function testReturnsJsonEncodedItems()
    {
        $collection = new \App\Support\Collection([
            ['username' => 'Alex'],
            ['username' => 'Billy'],
        ]);

        $this->assertIsString($collection->toJson());
        $this->assertEquals(
            '[{"username":"Alex"},{"username":"Billy"}]',
            $collection->toJson()
        );
    }
}
