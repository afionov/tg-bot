<?php

namespace Bot\Helper\DTO\Hydrator\Exception;

class InternalClassException extends HydratorException
{
    public function __construct(string $className)
    {
        parent::__construct(
            sprintf(
                '"%s" class constructor is not public or the class does not have a constructor.',
                $className
            )
        );
    }
}