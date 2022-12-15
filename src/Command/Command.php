<?php

namespace Bot\Command;

use Bot\Command\Worker\WorkerInterface;
use Bot\Interfaces\WebhookHandlerInterface;

abstract class Command implements WebhookHandlerInterface
{
    public function __construct(
        protected WorkerInterface $worker
    ) {
    }
}