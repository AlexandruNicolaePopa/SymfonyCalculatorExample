<?php

namespace App\Calculator\Domain\Exception;

class CalculatorException extends \InvalidArgumentException
{
    /**
     * Initialized it like this instead of using the InvalidArgumentException because we may extend it
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
