<?php

namespace Bot\Service\Hydrator\EntityHydrator\Attribute;


use Bot\Service\Hydrator\EntityHydrator\Attribute\Worker\WorkerInterface;

interface AttributeInterface
{
    public function getWorker(): WorkerInterface;
}