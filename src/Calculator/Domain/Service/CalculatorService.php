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

    public function calculate($expression)
    {
        $this->calculator->calculate($expression);
    }

    public function getResult()
    {
        return $this->calculator->getResult();
    }
}