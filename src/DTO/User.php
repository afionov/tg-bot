<?php

namespace Bot\DTO;

class User extends DTO
{
    /**
     * @var int
     * Unique identifier for this user or bot.
     * This number may have more than 32 significant bits and some programming
     * languages may have difficulty/silent defects in interpreting it.
     * But it has at most 52 significant bits, so a 64-bit integer or
     * double-precision float type are safe for storing this identifier.
     */
    public int $id;

    /**
     * @var bool
     * True, if this user is a bot
     */
    public bool $is_bot;

    /**
     * @var string
     * User's or bot's first name
     */
    public string $first_name;

    /**
     * @var string
     * Optional. User's or bot's last name
     */
    public string $last_name;

    /**
     * @var string Optional. User's or bot's username
     */
    public string $username;

    /**
     * @var string
     * Optional. IETF language tag of the user's language
     */
    public string $language_code;

    /**
     * @var bool
     * Optional. True, if this user is a Telegram Premium user
     */
    public bool $is_premium;

    /**
     * @var bool
     * Optional. True, if this user added the bot to the attachment menu
     */
    public bool $added_to_attachment_menu;

    /**
     * @var bool
     * True, if the bot can be invited to groups. Returned only in getMe.
     */
    public bool $can_join_groupsOptional;

    /**
     * @var bool
     * True, if privacy mode is disabled for the bot. Returned only in getMe.
     */
    public bool $can_read_all_group_messagesOptional;

    /**
     * @var bool
     * Optional. True, if the bot supports inline queries. Returned only in getMe.
     */
    public bool $supports_inline_queriesOptional;
}