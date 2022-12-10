<?php

namespace Bot\Entity;

interface EntityInterface
{
    public static function createFromArray(array $data): static;
}