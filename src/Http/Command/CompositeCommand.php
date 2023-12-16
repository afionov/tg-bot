<?php

namespace Bot\Http\Command;

final class CompositeCommand
{
    /**
     * @var list<Command>
     */
    protected array $commands = [];

    public function add(Command $command): CompositeCommand
    {
        $this->commands[] = $command;

        return $this;
    }

    public function shift(): ?Command
    {
        return array_shift($this->commands);
    }
}