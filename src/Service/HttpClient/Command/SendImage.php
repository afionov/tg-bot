<?php

namespace Bot\Service\HttpClient\Command;

use Bot\Entity\Telegram\Message;

class SendImage extends Command
{
    public function __construct(
        protected string|int $chatId,
        protected string $photo
    ) {
    }

    public function getMethod(): string
    {
        return 'sendPhoto';
    }

    public function getResponseEntity(): string
    {
        return Message::class;
    }

    public function getBody(): array
    {
        return [
            'chat_id' => $this->chatId,
            'photo' => $this->photo,
        ];
    }
}