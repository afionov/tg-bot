<?php

namespace Bot\Helper\DTO\Attribute;

use Attribute;
use Bot\DTO\DTO;
use Bot\Helper\DTO\Hydrator\Exception\AttributeValidationException;
use Bot\Helper\DTO\Hydrator\Exception\InternalClassException;
use Bot\Helper\DTO\Hydrator\Exception\InvalidDTOException;
use Bot\Helper\DTO\Hydrator\Exception\UndefinedDTOException;
use Bot\Helper\DTO\Hydrator\Hydrator;

#[Attribute]
final class ArrayOfDTO implements AttributeInterface
{
    /**
     * @param class-string<DTO> $dtoClassName
     */
    public function __construct(
        protected string $dtoClassName
    ) {
    }

    /**
     * @param mixed $value
     * @param AttributeHandleResult $result
     * @return AttributeHandleResult
     * @throws AttributeValidationException
     * @throws InternalClassException
     * @throws InvalidDTOException
     * @throws UndefinedDTOException
     */
    public function handleValue(mixed $value, AttributeHandleResult $result): AttributeHandleResult
    {
        if (!is_array($value)) {
            $result->addError('Value must be an array');
            return $result;
        }

        $resultValue = [];

        /**
         * @var array $innerValue
         */
        foreach ($value as $innerValue) {
            $resultValue[] = Hydrator::hydrate($this->dtoClassName, $innerValue);
        }

        $result->setResult($resultValue);

        return $result;
    }
}