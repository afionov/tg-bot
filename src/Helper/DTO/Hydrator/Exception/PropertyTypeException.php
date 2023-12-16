<?php

namespace Bot\Helper\DTO\Hydrator\Exception;

use ReflectionIntersectionType;
use ReflectionUnionType;

class PropertyTypeException extends HydratorException
{
    public function __construct(string $propertyName, ReflectionUnionType|ReflectionIntersectionType|null $propertyType)
    {
        parent::__construct(
            sprintf(
                'Unsupported property type "%s" for property "%s"',
                is_object($propertyType)
                    ? match (get_class($propertyType)) {
                        ReflectionUnionType::class => 'union',
                        ReflectionIntersectionType::class => 'intersection',
                        default => 'unknown'
                    }
                    : "empty type",
                $propertyName
            )
        );
    }
}