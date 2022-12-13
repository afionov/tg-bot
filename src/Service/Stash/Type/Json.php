<?php

namespace Bot\Service\Stash\Type;

use Bot\Service\Stash\Stash;
use InvalidArgumentException;

class Json implements StashTypeInterface
{
    protected const EMPTY_FILE_CONTENT = '[]';

    public function getExtension(): string
    {
        return 'json';
    }

    public function createStash(string $path): Stash
    {
        $content = $this->getFileContent($path);

        $result = json_decode($content, true);

        if (is_null($result)) {
            throw new InvalidArgumentException(sprintf('File "%s" is not valid JSON', $path));
        }

        return new Stash($result, $path, $this);
    }

    public function save(Stash $stash): void
    {
        file_put_contents(
            $stash->getPath(),
            $this->encodeData($stash->getData())
        );
    }

    protected function getFileContent($path): bool|string
    {
        if (!file_exists($path)) {
            return self::EMPTY_FILE_CONTENT;
        }

        return file_get_contents($path);
    }

    protected function encodeData(array $data): string
    {
        return json_encode($data);
    }
}