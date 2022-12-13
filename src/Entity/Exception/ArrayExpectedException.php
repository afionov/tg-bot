<?php

namespace Bot\Entity\Exception;

use Exception;

class ArrayExpectedException extends Exception
{
    public function __construct(string $fieldName, mixed $fieldValue, string $class)
    {
        parent::__construct(sprintf(
            'Field "%s" of class "%s" is expected to be an array, real is "%s"',
            $fieldName,
            $class,
            gettype($fieldValue)
        ));
    }
}