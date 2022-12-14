<?php

namespace Bot\Mode\Quest;

use Bot\Mode\Quest\Answer\Answer;
use Bot\Mode\Quest\Button\Format\ButtonFormatStrategy;
use Bot\Mode\Quest\Button\Format\TwoPerLineFormat;
use Bot\Mode\Quest\Content\Content;
use Bot\Mode\Quest\Content\ContentFactory;
use Bot\Mode\Quest\Content\ContentTypeEnum;
use Bot\Service\HttpClient\Command\SendKeyboard;
use Bot\Service\HttpClientService;
use Psr\Http\Client\ClientExceptionInterface;

final class Step
{
    protected string $id;

    protected array $content = [];

    protected array $answers = [];

    public static function fromDTO(DTO\Step $step, ButtonFormatStrategy $buttonFormatStrategy): Step
    {
        return new Step($step, $buttonFormatStrategy);
    }

    protected function __construct(
        DTO\Step                       $stepDTO,
        protected ButtonFormatStrategy $buttonFormatStrategy
    ) {
        $this->id = $stepDTO->id;

        foreach ($stepDTO->answer as $answer) {
            $this->answers[] = Answer::createFromDTO($answer);
        }

        foreach ($stepDTO->content as $content) {
            $this->content[] = ContentFactory::make($content);
        }
    }

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

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param HttpClientService $httpClientService
     * @param string|int $chatId
     * @return void
     * @throws ClientExceptionInterface
     */
    public function send(HttpClientService $httpClientService, string|int $chatId): void
    {
        $contents = $this->getContent();
        $lastContent = array_pop($contents);

        if (is_null($lastContent)) {
            return;
        }

        foreach ($contents as $content) {
            $httpClientService->sendCommand($content->getCommand($chatId));
        }

        $answers = [];

        foreach ($this->getAnswers() as $answer) {
            $answers[] = $answer->getButtonText();
        }

        if ($lastContent->getType() !== ContentTypeEnum::Text) {
            $httpClientService->sendCommand($lastContent->getCommand($chatId));
            $lastContent = null;
        }

        if (empty($answers)) {
            if (isset($lastContent)) {
                $httpClientService->sendCommand($lastContent->getCommand($chatId));
            }
            return;
        }

        $httpClientService->sendCommand(new SendKeyboard(
            $chatId,
            isset($lastContent) ? $lastContent->value : 'Выберите ответ',
            $answers,
            new TwoPerLineFormat()
        ));
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
}