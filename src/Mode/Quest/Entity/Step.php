<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Command\Formatter\Button\ButtonFormatStrategy;
use Bot\Mode\Quest\Entity\Step\Answer\Answer;
use Bot\Mode\Quest\Entity\Step\Content\Content;
use Bot\Mode\Quest\Entity\Step\Content\ContentFactory;
use Bot\Mode\Quest\Entity\Step\Content\ContentTypeEnum;
use Bot\Service\HttpClient\Command\SendKeyboard;
use RuntimeException;

class Step
{
    protected string $id;

    /**
     * @var array|Content[]
     */
    protected array $contents = [];

    /**
     * @var array|Answer[]
     */
    protected array $answers = [];

    public function __construct(array $step)
    {
        $this->id = $step['id'];

        foreach ($step['content'] as $content) {
            $this->contents[] = ContentFactory::make($content['type'], $content['value']);
        }

        foreach ($step['answer'] as $answer) {
            $this->answers[] = Answer::fromArray($answer);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function generateCommands(string|int $userId, ButtonFormatStrategy $buttonFormat): array
    {
        $contents = $this->contents;
        $commands = [];
        $lastContent = array_pop($contents);

        if (is_null($lastContent)) {
            return $commands;
        }

        foreach ($contents as $content) {
            $commands[] = $content->getCommand($userId);
        }

        $answers = [];

        foreach ($this->answers as $answer) {
            $answers[] = $answer->getButtonText();
        }

        if ($lastContent->getType() !== ContentTypeEnum::Text) {
            $commands[] = $lastContent->getCommand($userId);
            $lastContent = null;
        }

        if (empty($answers)) {
            if (isset($lastContent)) {
                $commands[] = $lastContent->getCommand($userId);
            }
            return $commands;
        }

        $commands[] = new SendKeyboard(
            $userId,
            isset($lastContent) ? $lastContent->value : 'Выберите ответ',
            $answers,
            $buttonFormat
        );

        return $commands;
    }

    public function getStepIdToMoveByMessage(string $message): string
    {
        foreach ($this->answers as $answer) {
            if ($answer->getButtonText() === $message) {
                return $answer->getStepIdToMove();
            }
        }

        throw new RuntimeException('Не найдено сообщение');
    }
}