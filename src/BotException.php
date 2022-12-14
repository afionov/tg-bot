<?php

namespace Bot;

use Exception;
use Throwable;

/**
 * Parent exception for bot exceptions
 */
class BotException extends Exception
{
    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}