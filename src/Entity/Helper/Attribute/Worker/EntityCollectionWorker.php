<?php

namespace Bot\Entity\Helper\Attribute\Worker;

use Bot\Entity\Exception\InvalidEntityException;
use Bot\Entity\Helper\Hydrator;
use ReflectionException;

final class EntityCollectionWorker implements WorkerInterface
{
    public function __construct(
        protected string $entityClassName
    ) {
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
            $result[] = Hydrator::hydrate($this->entityClassName, $innerValue);
        }

        return $result;
    }
}