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

    public function getBody(): array
    {
        return array_merge(parent::getBody(), [
            'reply_markup' => [
                'keyboard' => $this->buttonFormatter->format($this->buttonTexts)
            ]
        ]);
    }
}