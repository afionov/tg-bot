<?php

namespace Bot\Helper\DTO\Attribute;

use Attribute;

#[Attribute]
final class Required implements AttributeInterface
{
    public function __construct()
    {
    }

    public function handleValue(mixed $value, AttributeHandleResult $result): AttributeHandleResult
    {
        if (is_null($value)) {
            $result->addError('Property in required');

            return $result;
        }

        $result->setResult($value);

        return $result;
    }
}