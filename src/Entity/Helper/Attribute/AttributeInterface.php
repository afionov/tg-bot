<?php

namespace Bot\Entity\Helper\Attribute;

use Bot\Entity\Helper\Attribute\Worker\WorkerInterface;

interface AttributeInterface
{
    public function getWorker(): WorkerInterface;
}