<?php

namespace Bot\DTO;

use Bot\Interfaces\ArrayableInterface;
use Bot\Service\Hydrator\HydratableInterface;

abstract class DTO implements ArrayableInterface, HydratableInterface
{
    final public function toArray(): array
    {
        return $this->__toArray((array) $this);
    }

    final protected function __toArray($array): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_object($value)) {
                if (!$value instanceof DTO) {
                    throw new \RuntimeException('');
                }
                $result[$key] = $value->toArray();
                continue;
            }
            if (is_array($value)) {
                $result[$key] = $this->__toArray($value);
                continue;
            }
            $result[$key] = $value;
        }

        return $result;
    }
}