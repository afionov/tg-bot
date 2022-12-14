<?php

namespace Bot\Service\Hydrator\EntityHydrator\Attribute\Worker;

use Bot\Service\HydratorService;

final class EntityCollectionWorker implements WorkerInterface
{
    public function __construct(
        protected string $entityClassName,
        protected HydratorService $hydratorService
    ) {
    }

    /**
     * @param mixed $value
     * @return array
     */
    public function handle(mixed $value): array
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('Value must be an array');
        }

        $result = [];

        foreach ($value as $innerValue) {
            $result[] = $this->hydratorService->hydrate($this->entityClassName, $innerValue);
        }

        return $result;
    }
}