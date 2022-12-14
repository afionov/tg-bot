<?php

namespace Bot\Mode;

use Bot\Service\Hydrator\HydratableInterface;
use Bot\Service\HydratorService;

interface ModeInterface
{
    public function handleWebhook(HydratableInterface $webhook): void;

    public function getModeHydrator(): HydratorService;
}