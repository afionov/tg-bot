<?php

namespace Bot\Http\Command;

use Bot\DTO\Message;

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

    public function getResponseDTOClassName(): string
    {
        return Message::class;
    }
}