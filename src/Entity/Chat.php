<?php

namespace Bot\Entity;

class Chat extends Entity
{
    /**
     * @var int
     * Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     */
    public int $id;

    /**
     * @var string
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     */
    public string $type;

    /**
     * @var string
     * Optional. Title, for supergroups, channels and group chats
     */
    public string $title;

    /**
     * @var string
     * Optional. Username, for private chats, supergroups and channels if available
     */
    public string $username;

    /**
     * @var string
     * Optional. First name of the other party in a private chat
     */
    public string $first_name;

    /**
     * @var string
     * Optional. Last name of the other party in a private chat
     */
    public string $last_name;

    /**
     * @var ChatPhoto
     * Optional. Chat photo. Returned only in getChat.
     */
    public ChatPhoto $photo;

    /**
     * @var string
     * Optional. Bio of the other party in a private chat. Returned only in getChat.
     */
    public string $bio;

    /**
     * @var bool
     * Optional. True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user. Returned only in getChat.
     */
    public bool $has_private_forwards;

    /**
     * @var bool
     * Optional. True, if the privacy settings of the other party restrict sending voice and video note messages in the private chat. Returned only in getChat.
     */
    public bool $has_restricted_voice_and_video_messages;

    /**
     * @var bool
     * Optional. True, if users need to join the supergroup before they can send messages. Returned only in getChat.
     */
    public bool $join_to_send_messages;

    /**
     * @var bool
     * Optional. True, if all users directly joining the supergroup need to be approved by supergroup administrators. Returned only in getChat.
     */
    public bool $join_by_request;

    /**
     * @var string
     * Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
     */
    public string $description;

    /**
     * @var string
     * Optional. Primary invite link, for groups, supergroups and channel chats. Returned only in getChat.
     */
    public string $invite_link;
    /**
     * @var Message
     * Optional. The most recent pinned message (by sending date). Returned only in getChat.
     */
    public Message $pinned_message;

    /**
     * @var ChatPermissions
     * Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
     */
    public ChatPermissions $permissions;

    /**
     * @var int
     * Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user; in seconds. Returned only in getChat.
     */
    public int $slow_mode_delay;

    /**
     * @var int
     * Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat.
     */
    public int $message_auto_delete_time;

    /**
     * @var bool
     * Optional. True, if messages from the chat can't be forwarded to other chats. Returned only in getChat.
     */
    public bool $has_protected_content;

    /**
     * @var string
     * Optional. For supergroups, name of group sticker set. Returned only in getChat.
     */
    public string $sticker_set_name;

    /**
     * @var bool
     * Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     */
    public bool $can_set_sticker_set;

    /**
     * @var int
     * Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat.
     */
    public int $linked_chat_id;

    /**
     * @var ChatLocation
     * Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat.
     */
    public ChatLocation $location;
}