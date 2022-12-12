<?php

namespace Bot\Service\Stash\Type;

use Bot\Service\Stash\Stash;
use InvalidArgumentException;

class Json implements StashTypeInterface
{
    public function getExtension(): string
    {
        return 'json';
    }

    public function createStash(string $path): Stash
    {
        $content = file_get_contents($path);

        if ($content === false) {
            throw new InvalidArgumentException(sprintf('File "%s" is not readable', $path));
        }

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

    protected function encodeData(array $data): string
    {
        return json_encode($data);
    }
}