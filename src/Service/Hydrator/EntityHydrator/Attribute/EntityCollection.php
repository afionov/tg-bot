<?php

namespace Bot\Service\Hydrator\EntityHydrator\Attribute;

use Attribute;
use Bot\Service\Hydrator\EntityHydrator;
use Bot\Service\Hydrator\EntityHydrator\Attribute\Worker\EntityCollectionWorker;
use Bot\Service\Hydrator\EntityHydrator\Attribute\Worker\WorkerInterface;
use Bot\Service\HydratorService;

#[Attribute]
final class EntityCollection implements AttributeInterface
{
    protected HydratorService $hydratorService;

    public function __construct(
        protected string $entityClassName
    ) {
        $this->hydratorService = new HydratorService(new EntityHydrator());
    }

    public function getWorker(): WorkerInterface
    {
        return new EntityCollectionWorker($this->entityClassName, $this->hydratorService);
    }
}