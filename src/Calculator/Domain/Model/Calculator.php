<?php

namespace App\Calculator\Domain\Model;

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

    private function performCalculation($expression) {
        if (strpos($expression, 'sqrt') !== false) {
            $expression = preg_replace('/sqrt/', 'sqrt', $expression);
        }

        // check if the expression contains invalid characters
        if (!preg_match('/^[\d\s+\-\*\/\.]+$/', $expression)) {
            throw new \InvalidArgumentException('Invalid expression.');
        }

        // check if the expression starts or ends with an operator
        if (preg_match('/^[\+\-\*\/]|[\+\-\*\/]$/', $expression)) {
            throw new \InvalidArgumentException('Invalid expression.');
        }

        // check if the expression contains consecutive operators
        if (preg_match('/[\+\-\*\/]{2,}/', $expression)) {
            throw new \InvalidArgumentException('Invalid expression.');
        }

        // Replace " * " and " / " with their corresponding mathematical functions - stripping spaces
        $expression = preg_replace('/\*/', '*', $expression);
        $expression = preg_replace('/\//', '/', $expression);

        // Replace " + " and " - " with their corresponding mathematical functions - stripping spaces
        $expression = preg_replace('/\+/', '+', $expression);
        $expression = preg_replace('/\-/', '-', $expression);

        try {
            return eval('return ' . $expression . ';');
        } catch (Error $e) {
            return "Invalid expression.";
        }
    }
}