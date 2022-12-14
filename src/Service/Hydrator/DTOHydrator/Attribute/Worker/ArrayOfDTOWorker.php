<?php

namespace Bot\Service\Hydrator\DTOHydrator\Attribute\Worker;

use Bot\Service\HydratorService;

final class ArrayOfDTOWorker implements WorkerInterface
{
    public function __construct(
        protected string $dtoClassName,
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
            $result[] = $this->hydratorService->hydrate($this->dtoClassName, $innerValue);
        }

        return $result;
    }
}