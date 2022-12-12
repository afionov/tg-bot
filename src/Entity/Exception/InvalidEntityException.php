<?php

namespace Bot\Entity\Exception;

class InvalidEntityException extends \Exception
{
    public function __construct(string $entityClassName, string $message = '')
    {
        parent::__construct(
            sprintf(
                'Entity class `%s` is not valid. %s',
                $entityClassName,
                $message
            )
        );
    }
}