<?php

namespace Bot\Service\HttpClient\Command;

use Bot\Entity\Telegram\Message;

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

    public function getResponseEntity(): string
    {
        return Message::class;
    }

    public function getBody(): array
    {
        return [
            'chat_id' => $this->chatId,
            'sticker' => $this->sticker
        ];
    }
}