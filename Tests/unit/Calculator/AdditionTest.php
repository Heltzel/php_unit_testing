<?php

namespace App\Tests\Unit\Calculator;

class AdditionTest extends \PHPUnit\Framework\TestCase
{
    public function testAddsUpGivenOperands()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([5, 10]);

        $this->assertEquals(15, $addition->calculate());
    }

    public function testNoOperandsGivenThrowsExceptionWhenCalculating()
    {
        $this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);

        $addition = new \App\Calculator\Addition;
        $addition->calculate();
    }
}
