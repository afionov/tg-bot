<?php

namespace Bot\Service\Hydrator;

interface HydratorInterface
{
    public function hydrate(HydratableInterface|string $hydratable, array $source): HydratableInterface;
}