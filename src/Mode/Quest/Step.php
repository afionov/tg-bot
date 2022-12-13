<?php

namespace Bot\Mode\Quest;

use Bot\Mode\Quest\Answer\Answer;
use Bot\Mode\Quest\Content\Content;
use Bot\Mode\Quest\Content\ContentFactory;
use Bot\Service\HttpClient\Command\SendKeyboard;
use Bot\Service\HttpClientService;
use Psr\Http\Client\ClientExceptionInterface;

final class Step
{
    protected string $id;

    protected array $content = [];

    /**
     * @return array|Content[]
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @return array|Answer[]
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    protected array $answers = [];

    public static function fromEntity(Entity\Step $stepEntity): Step
    {
        return new Step($stepEntity);
    }

    /**
     * @param HttpClientService $httpClientService
     * @param string|int $chatId
     * @return void
     * @throws ClientExceptionInterface
     */
    public function send(HttpClientService $httpClientService, string|int $chatId): void
    {
        foreach ($this->getContent() as $content) {
            $httpClientService->sendCommand($content->getCommand($chatId));
        }

        $answers = [];

        foreach ($this->getAnswers() as $answer) {
            $answers[] = $answer->getButtonText();
        }

        if (empty($answers)) {
            return;
        }

        //TODO: strategy on button formatter
        $httpClientService->sendCommand(new SendKeyboard($chatId, $answers, new ButtonFormatter()));
    }

    protected function __construct(Entity\Step $stepEntity)
    {
        $this->id = $stepEntity->id;

        foreach ($stepEntity->answer as $answer) {
            $this->answers[] = Answer::createFromEntity($answer);
        }

        foreach ($stepEntity->content as $content) {
            $this->content[] = ContentFactory::make($content);
        }
    }

    public function getStepIdToMoveByMessage(string $message): string
    {
        foreach ($this->getAnswers() as $answer) {
            if ($answer->getButtonText() === $message) {
                return $answer->getStepIdToMove();
            }
        }

        throw new \RuntimeException('Не найдено сообщение');
    }

    public function getId(): string
    {
        return $this->id;
    }
}