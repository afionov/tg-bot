<?php

namespace Bot;

use Bot\Command\CommandInterface;
use Bot\Command\DefaultStartCommand;
use Bot\DTO\Update;
use Bot\Helper\DTO\Hydrator\Hydrator;
use Bot\Http\Command\CompositeCommand;
use Bot\Http\CompositeResponse;
use Bot\Http\Exception\BadRequestEnum;
use Bot\Http\Exception\BadRequestException;
use Bot\Http\HttpClient;
use Bot\Interfaces\WebhookHandlerInterface;
use Bot\Mode\ModeInterface;
use Bot\Mode\NullMode;
use Closure;
use Psr\Http\Client\ClientInterface;

final class Bot
{
    /**
     * @param string $token
     * @param ClientInterface $httpClient
     * @param null|Closure():ModeInterface $modeClass
     * @param array<string, Closure():CommandInterface> $commands
     * @param array<string, string> $additionalHeaders
     */
    public function __construct(
        protected string $token,
        protected ClientInterface $httpClient,
        protected ?Closure $modeClass,
        protected array $commands = ['/start' => fn (): CommandInterface => new DefaultStartCommand()],
        protected array $additionalHeaders = []
    ) {
        if (!isset($modeClass)) {
            $this->modeClass = fn (): ModeInterface => new NullMode();
        }
    }

    public function handleWebhook(): CompositeResponse
    {
        try {
            $webhookDTO = $this->createWebhookDTO();
        } catch (Helper\DTO\Hydrator\Exception\AttributeValidationException $e) {
        } catch (Helper\DTO\Hydrator\Exception\InternalClassException $e) {
        } catch (Helper\DTO\Hydrator\Exception\InvalidDTOException $e) {
        } catch (Helper\DTO\Hydrator\Exception\UndefinedDTOException $e) {
        }


        $text = $webhookDTO->message->text;

        /**
         * @var WebhookHandlerInterface $handler
         */
        $handler = $this->commands[$text] ?? $this->modeClass;
        $compositeCommand = $handler->handleWebhook($webhookDTO);

        return $this->sendCommands($compositeCommand);
    }

    /**
     * @return Update
     * @throws BadRequestException
     * @throws Helper\DTO\Hydrator\Exception\AttributeValidationException
     * @throws Helper\DTO\Hydrator\Exception\InternalClassException
     * @throws Helper\DTO\Hydrator\Exception\InvalidDTOException
     * @throws Helper\DTO\Hydrator\Exception\UndefinedDTOException
     */
    protected function createWebhookDTO(): Update
    {
        $requestData = file_get_contents('php://input');

        if ($requestData === false) {
            throw new BadRequestException(BadRequestEnum::EMPTY_REQUEST_BODY);
        }

        $requestArr = json_decode($requestData, true);

        if (!is_array($requestArr)) {
            throw new BadRequestException(BadRequestEnum::INVALID_REQUEST_BODY);
        }

        /**
         * @var Update $webhookDTO
         */
        $webhookDTO = Hydrator::hydrate(Update::class, $requestArr);

        return $webhookDTO;
    }


    protected function sendCommands(CompositeCommand $compositeCommand): CompositeResponse
    {
        $httpClient = new HttpClient($this->token, $this->httpClient, $this->additionalHeaders);
        $compositeResponse = new CompositeResponse();

        return $httpClient->sendCompositeCommand($compositeCommand, $compositeResponse);
    }
}