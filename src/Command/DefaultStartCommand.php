<?php

namespace Bot\Command;

use Bot\DTO\Update;
use Bot\Http\Command\CompositeCommand;
use Bot\Http\Command\SendMessage;

final class DefaultStartCommand implements CommandInterface
{
    public function handleWebhook(Update $webhookUpdate): CompositeCommand
    {
        $compositeCommand = new CompositeCommand();
        $compositeCommand->add(new SendMessage($webhookUpdate->message->from->id, 'Bot has started.'));

        return $compositeCommand;
    }
}