<?php

namespace Bot\Entity\Telegram;

use Bot\Entity\Entity;

final class Animation extends Entity
{
    /**
     * @var string
     * Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string
     * Unique identifier for this file, which is supposed to be the same over
     * time and for different bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int
     * Video width as defined by sender
     */
    public int $width;

    /**
     * @var int
     * Video height as defined by sender
     */
    public int $height;

    /**
     * @var int
     * Duration of the video in seconds as defined by sender
     */
    public int $duration;

    /**
     * @var PhotoSize
     * Optional. Animation thumbnail as defined by sender
     */
    public PhotoSize $thumb;

    /**
     * @var string
     * Optional. Original animation filename as defined by sender
     */
    public string $file_name;

    /**
     * @var string
     * Optional. MIME type of the file as defined by sender
     */
    public string $mime_type;

    /**
     * @var int
     * Optional. File size in bytes. It can be bigger than 2^31 and some
     * programming languages may have difficulty/silent defects in interpreting it.
     * But it has at most 52 significant bits, so a signed 64-bit integer or
     * double-precision float type are safe for storing this value.
     */
    public int $file_size;
}