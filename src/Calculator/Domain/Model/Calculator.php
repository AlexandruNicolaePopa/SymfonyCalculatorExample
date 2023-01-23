<?php

namespace App\Calculator\Domain\Model;

use App\Calculator\Domain\Exception\CalculatorException;

class Calculator
{
    /**Created this property in case we want to extend this class to perform operations on the current result */
    private $result;

    /**
     * It takes a string, and returns a number
     * 
     * @param expression The expression to calculate.
     */
    public function calculate($expression)
    {
        $this->result = $this->performCalculation($expression);
    }

    /**
     * It returns the result of the query
     * 
     * @return int the result stored in the result property
     */
    public function getResult()
    {
        return $this->result;
    }

   /**
    * It takes a string, checks if it's a valid expression, and if it is, it calculate it
    * 
    * @param expression The expression to be evaluated/calculated.
    * 
    * @return int The result of the calculation.
    */
    private function performCalculation($expression)
    {

        // check if the expression matches and return the number
        if (preg_match('/^(\d+) sqrt$/', $expression, $matches)) {
            $number = $matches[1];
            return sqrt($number);
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
