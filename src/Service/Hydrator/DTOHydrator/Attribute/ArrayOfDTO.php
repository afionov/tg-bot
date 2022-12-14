<?php

namespace Bot\Service\Hydrator\DTOHydrator\Attribute;

use Attribute;
use Bot\Service\Hydrator\DTOHydrator;
use Bot\Service\Hydrator\DTOHydrator\Attribute\Worker\ArrayOfDTOWorker;
use Bot\Service\Hydrator\DTOHydrator\Attribute\Worker\WorkerInterface;
use Bot\Service\HydratorService;

#[Attribute]
final class ArrayOfDTO implements AttributeInterface
{
    protected HydratorService $hydratorService;

    public function __construct(
        protected string $dtoClassName
    ) {
        $this->hydratorService = new HydratorService(new DTOHydrator());
    }

    public function getWorker(): WorkerInterface
    {
        return new ArrayOfDTOWorker($this->dtoClassName, $this->hydratorService);
    }
}