<?php

namespace Bot\Http;

use Bot\DTO\Update;
use Bot\Helper\DTO\Hydrator\Exception\AttributeValidationException;
use Bot\Helper\DTO\Hydrator\Exception\InternalClassException;
use Bot\Helper\DTO\Hydrator\Exception\InvalidDTOException;
use Bot\Helper\DTO\Hydrator\Exception\UndefinedDTOException;
use Bot\Helper\DTO\Hydrator\Hydrator;
use Bot\Http\Exception\BadRequest;
use Bot\Http\Exception\BadRequestException;
use LogicException;

final class Webhook
{
    /**
     * @return Update
     * @throws BadRequestException
     * @throws AttributeValidationException
     * @throws InternalClassException
     * @throws InvalidDTOException
     * @throws UndefinedDTOException
     */
    public static function createFromGlobalPayload(): Update
    {
        $requestData = file_get_contents('php://input');

        if ($requestData === false) {
            throw new BadRequestException(BadRequest::EMPTY_REQUEST_BODY);
        }

        $requestArr = json_decode($requestData, true);

        if (!is_array($requestArr)) {
            throw new BadRequestException(BadRequest::INVALID_REQUEST_BODY);
        }

        $dto = Hydrator::hydrate(Update::class, $requestArr);

        if (!$dto instanceof Update) {
            throw new LogicException();
        }

        return $dto;
    }
}