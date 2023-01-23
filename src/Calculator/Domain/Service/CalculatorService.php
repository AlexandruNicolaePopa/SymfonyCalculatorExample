<?php

namespace App\Calculator\Domain\Service;

use App\Calculator\Domain\Model\Calculator;

class CalculatorService
{
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    
    /**
     * It takes an expression, passes it to the calculator, and returns the result
     * 
     * @param expression The expression to calculate.
     * 
     * @return int The result of the calculation.
     */
    public function calculate($expression)
    {
        return $this->calculator->calculate($expression);
    }

    /**
     * The function returns the result of the calculator
     * 
     * @return int The result of the calculation.
     */
    public function getResult()
    {
        return $this->calculator->getResult();
    }
}
