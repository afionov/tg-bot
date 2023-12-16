<?php

namespace Bot\Helper\DTO\Hydrator\Exception;

use Bot\DTO\DTO;

class UndefinedDTOException extends HydratorException
{
    public function __construct(string|DTO $dto)
    {
        parent::__construct(
            sprintf(
                'DTO "%s" is not defined',
                is_object($dto) ? get_class($dto) : $dto
            )
        );
    }
}