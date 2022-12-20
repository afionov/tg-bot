<?php

namespace Bot\Http\Command;

use Bot\Helper\Formatter\Button\ButtonFormatStrategy;

class SendKeyboard extends SendMessage
{
    /**
     * @param int|string $chatId
     * @param string $text
     * @param non-empty-list<string> $buttonTexts
     * @param ButtonFormatStrategy $buttonFormatter
     */
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