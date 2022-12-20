<?php

namespace Bot\Http\Exception;

use Bot\BotException;

class BadRequestException extends BotException
{
    public function __construct(BadRequestEnum $badRequest) {
        parent::__construct(
            'Bad Request: ' . $badRequest->value,
            code: 400
        );
    }
}