<?php

namespace App\Tests\Unit\Calculator;

class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    public function testCanSetSingleOperation()
    {
        $addition =  new \App\Calculator\Addition;
        $addition->setOperands([5, 10]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperation($addition);
        $this->assertCount(1, $calculator->getOperations());
    }

    public function testCanSetMultiOperation()
    {
        $addition1 =  new \App\Calculator\Addition;
        $addition1->setOperands([5, 10]);

        $addition2 =  new \App\Calculator\Addition;
        $addition2->setOperands([2, 2]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition1,  $addition2]);


        $this->assertCount(2, $calculator->getOperations());
    }

    public function testOperationsAreIgnoredIfNotInstanceOfOperationsInterface()
    {
        $addition =  new \App\Calculator\Addition;
        $addition->setOperands([5, 10]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition,  'somethingSilly']);

        $this->assertCount(1, $calculator->getOperations());
    }

    public function testCanCalculateresult()
    {
        $addition =  new \App\Calculator\Addition;
        $addition->setOperands([5, 10]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperation($addition);

        $this->assertEquals(15, $calculator->calculate());
    }

    public function tetsCalculateMethodReturnsMultipleResults()
    {
        $addition =  new \App\Calculator\Addition;
        $addition->setOperands([5, 10]); //15

        $division =  new \App\Calculator\Division;
        $division->setOperands([50, 2]); // 25

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, $division]);

        $this->assertIsArray($calculator->calculate());
        $this->assertEquals(15, $calculator->calculate()[0]);
        $this->assertEquals(25, $calculator->calculate()[1]);
    }
}
