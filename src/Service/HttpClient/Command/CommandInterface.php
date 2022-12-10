<?php

namespace Bot\Service\HttpClient\Command;

use Bot\Entity\Entity;

interface CommandInterface
{
    public function getMethod(): string;
    public function getResponseEntity(): string|Entity;
}