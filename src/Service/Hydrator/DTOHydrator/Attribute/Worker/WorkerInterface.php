<?php

namespace Bot\Service\Hydrator\DTOHydrator\Attribute\Worker;

interface WorkerInterface
{
    public function handle(mixed $value): mixed;
}