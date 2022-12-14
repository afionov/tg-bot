<?php

namespace Bot\DI\Exception;

use Bot\BotException;

class ServiceNotDefinedException extends BotException
{
    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct(sprintf(
            'Service "%s" is not defined.',
            $name
        ));
    }
}