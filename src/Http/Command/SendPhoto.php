<?php

namespace Bot\Http\Command;

use Bot\DTO\Message;

class SendPhoto extends Command
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

    public function getBody(): array
    {
        return [
            'chat_id' => $this->chatId,
            'photo' => $this->photo,
        ];
    }

    public function getResponseDTOClassName(): string
    {
        return Message::class;
    }
}