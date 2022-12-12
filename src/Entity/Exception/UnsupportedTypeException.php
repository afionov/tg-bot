<?php

namespace Bot\Entity\Exception;

use Exception;

class UnsupportedTypeException extends Exception
{
    public function __construct(
        public string $propertyName
    )
    {
        parent::__construct('Unsupported type for property ' . $propertyName);
    }
}