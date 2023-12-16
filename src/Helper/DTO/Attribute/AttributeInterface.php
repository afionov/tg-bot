<?php

namespace Bot\Helper\DTO\Attribute;

interface AttributeInterface
{
    public function handleValue(mixed $value, AttributeHandleResult $result): AttributeHandleResult;
}