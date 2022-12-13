<?php

namespace Bot\Service\Stash\Exception;

use Exception;

class FileFormatException extends Exception
{
    public function __construct(string $fileName)
    {
        parent::__construct(
            $fileName . ' - file format is not valid. Expected JSON format.'
        );
    }
}