<?php

namespace Bot\Service\HttpClient\Command;

class SendImage extends Command
{
    public function getMethod(): string
    {
        return 'sendPhoto';
    }

    public function getResponseEntity(): string
    {
        return '';
    }
}