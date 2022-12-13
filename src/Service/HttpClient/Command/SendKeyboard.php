<?php

namespace Bot\Service\HttpClient\Command;

use Bot\Mode\Quest\ButtonFormatter;

class SendKeyboard extends SendMessage
{
    public function __construct(
        int|string $chatId,
        protected array $buttonTexts,
        protected ButtonFormatter $buttonFormatter
    )
    {
        parent::__construct($chatId, 'Выберите ответ');
    }

    public function getMethod(): string
    {
        return 'setChatMenuButton';
    }

    public function getResponseEntity(): string
    {
        return '';
    }

    public function getBody(): array
    {
        return array_merge(parent::getBody(), [
            'keyboard' => [
                $this->buttonFormatter->format($this->buttonTexts)
            ]
        ]);
    }
}