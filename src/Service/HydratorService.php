<?php

namespace Bot\Service;

use Bot\Service\Hydrator\HydratableInterface;
use Bot\Service\Hydrator\HydratorInterface;

final class HydratorService
{
    public function __construct(
        protected HydratorInterface $hydrator
    ) {
    }

    public function hydrate(HydratableInterface|string $hydratable, array $source): HydratableInterface
    {
        return $this->hydrator->hydrate($hydratable, $source);
    }

    public function setHydrator(HydratorInterface $hydrator): HydratorService
    {
        $this->hydrator = $hydrator;
        return $this;
    }
}