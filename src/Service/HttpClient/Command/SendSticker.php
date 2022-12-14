<?php

namespace Bot\Service\HttpClient\Command;

class SendSticker extends Command
{
    public function __construct(
        protected string|int $chatId,
        protected string $sticker
    ) {
    }

    public function getMethod(): string
    {
        return 'sendSticker';
    }

    public function getBody(): array
    {
        return [
            'chat_id' => $this->chatId,
            'sticker' => $this->sticker
        ];
    }
}