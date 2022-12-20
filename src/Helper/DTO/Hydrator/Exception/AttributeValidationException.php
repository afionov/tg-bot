<?php

namespace Bot\Helper\DTO\Hydrator\Exception;

class AttributeValidationException extends HydratorException
{
    public function __construct(string $attributeClassName, string $attributeErrorMessage)
    {
        parent::__construct(
            sprintf(
                'Attribute "%s" has caught errors: %s',
                $attributeClassName,
                $attributeErrorMessage
            )
        );
    }
}