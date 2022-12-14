<?php

namespace Bot\Service\Hydrator\DTOHydrator\Exception;

use Exception;

class UnsupportedTypeException extends Exception
{
    public function __construct(string $propertyName)
    {
        parent::__construct('Unsupported type for property ' . $propertyName);
    }
}