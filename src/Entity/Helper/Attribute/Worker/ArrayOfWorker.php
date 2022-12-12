<?php

namespace Bot\Entity\Helper\Attribute\Worker;

use Bot\Entity\Exception\InvalidEntityException;
use Bot\Entity\Helper\Hydrator;
use ReflectionException;

final class ArrayOfWorker implements WorkerInterface
{
    public function __construct(
        protected string $valueType
    )
    {
    }

    /**
     * @param mixed $value
     * @return array
     * @throws InvalidEntityException
     * @throws ReflectionException
     */
    public function handle(mixed $value): array
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('Value must be an array');
        }

        $result = [];

        foreach ($value as $innerValue) {
            $result[] = Hydrator::hydrate($this->valueType, $innerValue);
        }

        return $result;
    }
}