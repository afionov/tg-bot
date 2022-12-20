<?php

namespace Bot\DTO\Chat;

use Bot\DTO\DTO;
use Bot\DTO\Message;

final class Chat extends DTO
{
    /**
     * @var int
     * Unique identifier for this chat.<br>
     * This number may have more than 32 significant bits
     * and some programming languages may have difficulty/silent defects in interpreting it.
     * But it has at most 52 significant bits, so a signed 64-bit integer
     * or double-precision float type are safe for storing this identifier.
     */
    public int $id;

    /**
     * @var string
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     */
    public string $type;

    /**
     * @var string
     * Optional. <br>
     * Title, for supergroups, channels and group chats
     */
    public string $title;

    /**
     * @var string
     * Optional.<br>
     * Username, for private chats, supergroups and channels if available
     */
    public string $username;

    /**
     * @var string
     * Optional. <br>
     * First name of the other party in a private chat
     */
    public string $first_name;

    /**
     * @var string
     * Optional <br>
     * Last name of the other party in a private chat
     */
    public string $last_name;

    /**
     * @var ChatPhoto
     * Optional <br>
     * Chat photo. <br>
     * Returned only in getChat.
     */
    public ChatPhoto $photo;

    /**
     * @var string
     * Optional. <br>
     * Bio of the other party in a private chat. <br>
     * Returned only in getChat.
     */
    public string $bio;

    /**
     * @var bool
     * Optional. <br>
     * True, if privacy settings of the other party in the private chat allows
     * to use tg://user?id=<user_id> links only in chats with the user. <br>
     * Returned only in getChat.
     */
    public bool $has_private_forwards;

    /**
     * @var bool
     * Optional. <br>
     * True, if the privacy settings of the other party restrict sending voice
     * and video note messages in the private chat. <br>
     * Returned only in getChat.
     */
    public bool $has_restricted_voice_and_video_messages;

    /**
     * @var bool
     * Optional. <br>
     * True, if users need to join the supergroup before they can send messages. <br>
     * Returned only in getChat.
     */
    public bool $join_to_send_messages;

    /**
     * @var bool
     * Optional. <br>
     * True, if all users directly joining the supergroup need to be approved by supergroup administrators.<br>
     * Returned only in getChat.
     */
    public bool $join_by_request;

    /**
     * @var string
     * Optional. <br>
     * Description, for groups, supergroups and channel chats. <br>
     * Returned only in getChat.
     */
    public string $description;

    /**
     * @var string
     * Optional. <br>
     * Primary invite link, for groups, supergroups and channel chats. <br>
     * Returned only in getChat.
     */
    public string $invite_link;
    /**
     * @var Message
     * Optional. <br>
     * The most recent pinned message (by sending date). <br>
     * Returned only in getChat.
     */
    public Message $pinned_message;

    /**
     * @var ChatPermissions
     * Optional <br>
     * Default chat member permissions, for groups and supergroups. <br>
     * Returned only in getChat.
     */
    public ChatPermissions $permissions;

    /**
     * @var int
     * <i>Optional</i><br>
     * For supergroups, the minimum allowed delay between consecutive messages sent by each unprivileged user <br>
     * In seconds <br>
     * Returned only in getChat.
     */
    public int $slow_mode_delay;

    /**
     * @var int
     * Optional <br>
     * The time after which all messages sent to the chat will be automatically deleted <br>
     * in seconds <br>
     * Returned only in getChat.
     */
    public int $message_auto_delete_time;

    /**
     * @var bool
     * Optional <br>
     * True, if messages from the chat can't be forwarded to other chats. <br>
     * Returned only in getChat.
     */
    public bool $has_protected_content;

    /**
     * @var string
     * Optional <br>
     * For supergroups, name of group sticker set. <br>
     * Returned only in getChat.
     */
    public string $sticker_set_name;

    /**
     * @var bool
     * Optional <br>
     * True, if the bot can change the group sticker set. <br>
     * Returned only in getChat.
     */
    public bool $can_set_sticker_set;

    /**
     * @var int
     * Optional <br>
     * Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa;
     * for supergroups and channel chats.
     * This identifier may be greater than 32 bits and some programming languages may have
     * difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer
     * or double-precision float type are safe for storing this identifier.  <br>
     * Returned only in getChat.
     */
    public int $linked_chat_id;

    /**
     * @var ChatLocation
     * Optional<br>
     * For supergroups, the location to which the supergroup is connected.<br>
     * Returned only in getChat.
     */
    public ChatLocation $location;
}