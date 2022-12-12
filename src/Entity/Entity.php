<?php

namespace Bot\Entity;

use Bot\General\ArrayableInterface;

abstract class Entity implements ArrayableInterface
{
    final public function toArray(): array
    {
    }
}