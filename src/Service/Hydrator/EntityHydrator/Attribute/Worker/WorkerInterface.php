<?php

namespace Bot\Service\Hydrator\EntityHydrator\Attribute\Worker;

interface WorkerInterface
{
    public function handle(mixed $value): mixed;
}