<?php

namespace Tests\Calculator\Domain\Model;

use App\Calculator\Domain\Model\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAddition()
    {
        $calculator = new Calculator();
        $calculator->calculate('5 + 2');
        $this->assertEquals(7, $calculator->getResult());
    }

    public function testSubtraction()
    {
        $calculator = new Calculator();
        $calculator->calculate('5 - 2');
        $this->assertEquals(3, $calculator->getResult());
    }

    public function testMultiplication()
    {
        $calculator = new Calculator();
        $calculator->calculate('5 * 2');
        $this->assertEquals(10, $calculator->getResult());
    }

    public function testDivision()
    {
        $calculator = new Calculator();
        $calculator->calculate('10 / 2');
        $this->assertEquals(5, $calculator->getResult());
    }

    public function testSquareRoot()
    {
        $calculator = new Calculator();
        $calculator->calculate('9 sqrt');
        $this->assertEquals(3, $calculator->getResult());
    }

    public function testInvalidExpressionCharacters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The expression contains invalid characters.');
        $calculator = new Calculator();
        $calculator->calculate('5 & 2');
    }

    public function testInvalidExceptionOperatorsAtStartOrEnd()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The expression starts or ends with an operator.');
        $calculator = new Calculator();
        $calculator->calculate('+ 2 +');
    }

    public function testInvalidExpressionConsecutiveOperators()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The expression contains consecutive operators.');
        $calculator = new Calculator();
        $calculator->calculate('2 ++ 5');
    }
}
