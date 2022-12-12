<?php

namespace Bot\Entity\Helper;

final class SimpleArrayHelper
{
    public function __construct(
        protected array $array
    )
    {
    }

    public function map(string $from, ?string $to): array
    {
        return array_column($this->array, $from, $to);
    }
}