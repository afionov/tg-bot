<?php

namespace Bot\Helper\DTO\Hydrator\Exception;

class InvalidDTOException extends HydratorException
{
    public function __construct(string $dtoClassName, string $message)
    {
        parent::__construct(
            sprintf(
                '"%s" is not a valid - "%s"',
                $dtoClassName,
                $message
            )
        );
    }
}