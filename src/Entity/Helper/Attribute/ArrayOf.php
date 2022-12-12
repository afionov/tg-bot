<?php

namespace Bot\Entity\Helper\Attribute;

use Bot\Entity\Helper\Attribute\Worker\ArrayOfWorker;
use Bot\Entity\Helper\Attribute\Worker\WorkerInterface;

#[\Attribute]
final class ArrayOf implements AttributeInterface
{
    public function __construct(
        protected string $typeOfValues
    )
    {
    }

    public function getWorker(): WorkerInterface
    {
        return new ArrayOfWorker($this->typeOfValues);
    }
}