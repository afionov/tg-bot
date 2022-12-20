<?php

namespace Bot\Http\Command;

use Bot\DTO\Message;

class SendMessage extends Command
{
    public function __construct(
        protected string|int $chatId,
        protected string $text
    ) {
    }

    public function getMethod(): string
    {
        return 'sendMessage';
    }

    public function getBody(): array
    {
        return [
            'chat_id' => $this->chatId,
            'text' => $this->text
        ];
    }

    public function getResponseDTOClassName(): string
    {
        return Message::class;
    }
}