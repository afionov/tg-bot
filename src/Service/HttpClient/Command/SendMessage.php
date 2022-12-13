<?php

namespace Bot\Service\HttpClient\Command;

use Bot\Entity\Telegram\Message;

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

    public function getResponseEntity(): string
    {
        return Message::class;
    }

    public function getBody(): array
    {
        return [
            'chat_id' => $this->chatId,
            'text' => $this->text
        ];
    }
}