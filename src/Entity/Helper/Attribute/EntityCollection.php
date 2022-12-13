<?php

namespace Bot\Entity\Helper\Attribute;

use Bot\Entity\Helper\Attribute\Worker\EntityCollectionWorker;
use Bot\Entity\Helper\Attribute\Worker\WorkerInterface;

#[\Attribute]
final class EntityCollection implements AttributeInterface
{
    public function __construct(
        protected string $entityClassName
    ) {
    }

    public function getWorker(): WorkerInterface
    {
        return new EntityCollectionWorker($this->entityClassName);
    }
}