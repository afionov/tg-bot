<?php

namespace Bot\Http;

use Bot\DTO\DTO;

final class CompositeResponse
{
    protected array $responses = [];

    public function addResponse(DTO $response): void
    {
        $this->responses[] = $response;
    }

    public function getResponses(): array
    {
        return $this->responses;
    }
}