<?php

namespace Bot\Service\HttpClient\Command;

class CreateButton extends Command
{
    public function getMethod(): string
    {
        return 'setChatMenuButton';
    }

    public function getResponseEntity(): string
    {
        return '';
    }
}