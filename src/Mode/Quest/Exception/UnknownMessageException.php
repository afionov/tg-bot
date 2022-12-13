<?php

namespace Bot\Mode\Quest\Exception;

class UnknownMessageException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(sprintf(
            'Unknown message: %s',
            $message
        ));
    }
}