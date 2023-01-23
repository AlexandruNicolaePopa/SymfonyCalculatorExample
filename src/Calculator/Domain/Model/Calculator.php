<?php

namespace App\Calculator\Domain\Model;

use App\Calculator\Domain\Exception\CalculatorException;

class Calculator
{
    private $result;

    public function calculate($expression)
    {
        $this->result = $this->performCalculation($expression);
    }

    public function getResult()
    {
        return $this->result;
    }

    private function performCalculation($expression)
    {

        //Replace the " sqrt" with the corresponding mathematical function - stripping spaces
        if (strpos($expression, 'sqrt') !== false) {
            $expression = preg_replace('/sqrt/', 'sqrt', $expression);
        }

        // check if the expression contains invalid characters
        if (!preg_match('/^[\d\s+\-\*\/\.]+$/', $expression)) {
            throw new CalculatorException('The expression contains invalid characters.');
        }

        // check if the expression starts or ends with an operator
        if (preg_match('/^[\+\-\*\/]|[\+\-\*\/]$/', $expression)) {
            throw new CalculatorException('The expression starts or ends with an operator.');
        }

        // check if the expression contains consecutive operators
        if (preg_match('/[\+\-\*\/]{2,}/', $expression)) {
            throw new CalculatorException('The expression contains consecutive operators.');
        }

        return eval('return ' . $expression . ';');
    }
}
