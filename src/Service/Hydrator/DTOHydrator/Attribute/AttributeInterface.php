<?php

namespace Bot\Service\Hydrator\DTOHydrator\Attribute;


use Bot\Service\Hydrator\DTOHydrator\Attribute\Worker\WorkerInterface;

interface AttributeInterface
{
    public function getWorker(): WorkerInterface;
}