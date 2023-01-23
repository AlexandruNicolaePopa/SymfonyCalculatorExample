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
        try {
            return eval('return ' . $expression . ';');
        } catch (Error $e) {
            return "Invalid expression.";
        }
    }
}