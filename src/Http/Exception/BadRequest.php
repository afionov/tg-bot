<?php

namespace Bot\Http\Exception;

enum BadRequest: string
{
    case EMPTY_REQUEST_BODY = 'Empty request body.';

    case INVALID_REQUEST_BODY = 'Could not decode request body.';
}