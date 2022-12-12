<?php

namespace Bot\Entity\Helper\Attribute\Worker;

interface WorkerInterface
{
    public function handle(mixed $value): mixed;
}