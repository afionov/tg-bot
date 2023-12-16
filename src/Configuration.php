<?php

namespace Bot;

use Bot\Command\CommandInterface;
use Bot\Command\DefaultStartCommand;
use Bot\Mode\ModeInterface;
use Bot\Mode\NullMode;
use Closure;
use Psr\Http\Client\ClientInterface;

final class Configuration
{
    /**
     * @var Closure(): ModeInterface
     */
    protected Closure $mode;

    /**
     * @var array<string, callable():CommandInterface>
     */
    protected array $commands;

    /**
     * @var array<string, string>
     */
    protected array $additionalHeaders = [];

    public function __construct(
        protected readonly string $token,
        protected readonly ClientInterface $httpClient
    ) {
        $this->mode = fn (): ModeInterface => new NullMode();
        $this->commands = ['/start' => fn (): CommandInterface => new DefaultStartCommand()];
    }

    /**
     * @param Closure():ModeInterface $mode
     * @return void
     */
    public function setMode(Closure $mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @param array<string, callable():CommandInterface> $commands
     */
    public function setCommands(array $commands): void
    {
        $this->commands = $commands;
    }

    /**
     * @param string $command
     * @param callable():CommandInterface $commandWorker
     * @return $this
     */
    public function addCommand(string $command, callable $commandWorker): Configuration
    {
        $this->commands[$command] = $commandWorker;

        return $this;
    }

    /**
     * @param array<string, string> $additionalHeaders
     * @return void
     */
    public function setAdditionalHeaders(array $additionalHeaders): void
    {
        $this->additionalHeaders = $additionalHeaders;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function addAdditionalHeader(string $name, string $value): Configuration
    {
        $this->additionalHeaders[$name] = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @return array<string, string>
     */
    public function getAdditionalHeaders(): array
    {
        return $this->additionalHeaders;
    }

    /**
     * @param string $command
     * @return bool
     */
    public function hasCommand(string $command): bool
    {
        return isset($this->commands[$command]);
    }

    /**
     * @param string $command
     * @return CommandInterface
     */
    public function getCommand(string $command): CommandInterface
    {
        return ($this->commands[$command])();
    }

    /**
     * @return ModeInterface
     */
    public function getMode(): ModeInterface
    {
        return ($this->mode)();
    }
}