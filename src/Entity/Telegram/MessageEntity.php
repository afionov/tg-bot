<?php

namespace Bot\Entity\Telegram;

use Bot\Entity\Entity;

class MessageEntity extends Entity
{
    /**
     * @var string
     * Type of the entity. <br>
     * Currently, can be <br>
     * <ul>
     * <li>“mention” (username) </li>
     * <li>“hashtag” (#hashtag) </li>
     * <li>“cashtag” ($USD) </li>
     * <li>“bot_command” (/start jobs_bot) </li>
     * <li>“url” (https://telegram.org) </li>
     * <li>“email” (do-not-reply@telegram.org) </li>
     * <li>“phone_number” (+1-212-555-0123) </li>
     * <li>“bold” (bold text) </li>
     * <li>“italic” (italic text) </li>
     * <li>“underline” (underlined text) </li>
     * <li>“strikethrough” (strikethrough text) </li>
     * <li>“spoiler” (spoiler message) </li>
     * <li>“code” (monowidth string) </li>
     * <li>“pre” (monowidth block) </li>
     * <li>“text_link” (for clickable text URLs) </li>
     * <li>“text_mention” (for users without usernames) </li>
     * <li>“custom_emoji” (for inline custom emoji stickers) </li>
     * </ul>
     */
    public string $type;

    /**
     * @var int
     * Offset in UTF-16 code units to the start of the entity
     */
    public int $offset;

    /**
     * @var int
     * Length of the entity in UTF-16 code units
     */
    public int $length;

    /**
     * @var string
     * Optional <br>
     * For “text_link” only, URL that will be opened after user taps on the text
     */
    public string $url;

    /**
     * @var User
     * Optional <br>
     * For “text_mention” only, the mentioned user
     */
    public User $user;

    /**
     * @var string
     * Optional <br>
     * For “pre” only, the programming language of the entity text
     */
    public string $language;

    /**
     * @var string
     * Optional <br>
     * For “custom_emoji” only, unique identifier of the custom emoji.
     * Use getCustomEmojiStickers to get full information about the sticker
     */
    public string $custom_emoji_id;
}