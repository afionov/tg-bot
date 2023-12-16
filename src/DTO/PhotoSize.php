<?php

namespace Bot\DTO;

final class PhotoSize extends DTO
{
    /**
     * @var string
     * Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string
     * Unique identifier for this file, which is supposed to be the same over time and for different bots.
     * Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int
     * Optional
     * Photo width.
     */
    public int $width;

    /**
     * @var int
     * Optional <br>
     * Photo height.
     */
    public int $height;

    /**
     * @var int
     * Optional <br>
     * File size in bytes
     */
    public int $file_size;
}