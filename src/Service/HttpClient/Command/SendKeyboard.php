<?php

namespace Bot\Service\HttpClient\Command;

use Bot\Mode\Quest\Button\Format\ButtonFormatStrategy;

class SendKeyboard extends SendMessage
{
    public function __construct(
        int|string $chatId,
        string $text,
        protected array $buttonTexts,
        protected ButtonFormatStrategy $buttonFormatter
    )
    {
        parent::__construct($chatId, $text);
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