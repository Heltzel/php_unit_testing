<?php

namespace App\Tests\Unit\Calculator;

class DivisionTest extends \PHPUnit\Framework\TestCase
{
    public function testDividesGivenOperands()
    {
        $division = new  \App\Calculator\Division;
        $division->setOperands([100, 2]);
        $this->assertEquals(50, $division->calculate());
    }

    public function testNoOperandsGivenThrowsExceptionWhenCalculating()
    {
        $this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);

        $division = new \App\Calculator\Division;
        $division->calculate();
    }

    public function testRemovesDivisionByZeroOperands()
    {
        $division = new  \App\Calculator\Division;
        $division->setOperands([10, 0, 0, 5, 0]);

        $this->assertEquals(2, $division->calculate());
    }
}
