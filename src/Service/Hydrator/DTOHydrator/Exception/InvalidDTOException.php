<?php

namespace Bot\Service\Hydrator\DTOHydrator\Exception;

use Exception;

class InvalidDTOException extends Exception
{
    public function __construct(string $dtoClassName, string $message = '')
    {
        parent::__construct(
            sprintf(
                'DTO `%s` is not valid. %s',
                $dtoClassName,
                $message
            )
        );
    }
}