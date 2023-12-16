<?php

namespace Bot\Mode;

use Bot\DTO\Update;
use Bot\Http\Command\CompositeCommand;

final class NullMode implements ModeInterface
{
    public function handleWebhook(Update $webhookUpdate): CompositeCommand
    {
        return new CompositeCommand();
    }
}