<?php

namespace Bot\DTO;

use Bot\DTO\Chat\Chat;
use Bot\DTO\Poll\Poll;
use Bot\DTO\Sticker\Sticker;
use Bot\DTO\Video\Video;
use Bot\DTO\Video\VideoNote;
use Bot\DTO\VideoChat\VideoChatEnded;
use Bot\DTO\VideoChat\VideoChatParticipantsInvited;
use Bot\DTO\VideoChat\VideoChatScheduled;
use Bot\DTO\VideoChat\VideoChatStarted;
use Bot\Helper\DTO\Attribute\ArrayOfDTO;

class Message extends DTO
{
    /**
     * @var int
     * Unique message identifier inside this chat
     */
    public int $message_id;

    /**
     * @var User
     * Optional<br>
     * Sender of the message<br>
     * empty for messages sent to channels.<br>
     * For backward compatibility, the field contains a fake sender user
     * in non-channel chats, if the message was sent on behalf of a chat.
     */
    public User $from;

    /**
     * @var Chat
     * Optional. <br>
     * Sender of the message, sent on behalf of a chat.<br>
     * For example, the channel itself for channel posts,
     * the supergroup itself for messages from anonymous group administrators,
     * the linked channel for messages automatically forwarded
     * to the discussion group. For backward compatibility,
     * the field from contains a fake sender user in non-channel chats,
     * if the message was sent on behalf of a chat.
     */
    public Chat $sender_chat;

    /**
     * @var int
     * Date the message was sent in Unix time
     */
    public int $date;

    /**
     * @var Chat
     * Conversation the message belongs to
     */
    public Chat $chat;

    /**
     * @var User
     * Optional. For forwarded messages, sender of the original message
     */
    public User $forward_from;

    /**
     * @var Chat
     * Optional. For messages forwarded from channels or from
     * anonymous administrators, information about the original sender chat
     */
    public Chat $forward_from_chat;

    /**
     * @var int
     * Optional. For messages forwarded from channels, identifier of the original message in the channel
     */
    public int $forward_from_message_id;

    /**
     * @var string
     * Optional. For forwarded messages that were originally sent in channels or
     * by an anonymous chat administrator, signature of the message sender if present
     */
    public string $forward_signature;

    /**
     * @var string
     * Optional. Sender's name for messages forwarded from users who disallow
     * adding a link to their account in forwarded messages
     */
    public string $forward_sender_name;

    /**
     * @var int
     * Optional. For forwarded messages, date the original message was sent in Unix time
     */
    public int $forward_date;

    /**
     * @var bool
     * Optional. True, if the message is a channel post that was
     * automatically forwarded to the connected discussion group
     */
    public bool $is_automatic_forward;

    /**
     * @var Message
     * Optional. For replies, the original message. Note that the Message
     * object in this field will not contain further reply_to_message fields even if it itself is a reply.
     */
    public Message $reply_to_message;

    /**
     * @var User
     * Optional. Bot through which the message was sent
     */
    public User $via_bot;

    /**
     * @var int
     * Optional. Date the message was last edited in Unix time
     */
    public int $edit_date;

    /**
     * @var bool
     * Optional. True, if the message can't be forwarded
     */
    public bool $has_protected_content;

    /**
     * @var string
     * Optional. The unique identifier of a media message group this message belongs to
     */
    public string $media_group_id;

    /**
     * @var string
     * Optional. Signature of the post author for messages in channels,
     * or the custom title of an anonymous group administrator
     */
    public string $author_signature;

    /**
     * @var string
     * Optional. For text messages, the actual UTF-8 text of the message
     */
    public string $text;

    /**
     * @var MessageEntity[]
     * Optional. For text messages, special entities like usernames,
     * URLs, bot commands, etc. that appear in the text
     */
    #[ArrayOfDTO(MessageEntity::class)]
    public array $entities;

    /**
     * @var Animation
     * Optional. Message is an animation, information about the animation.
     * For backward compatibility, when this field is set, the document field will also be set
     */
    public Animation $animation;

    /**
     * @var Audio
     * Optional. Message is an audio file, information about the file
     */
    public Audio $audio;

    /**
     * @var Document
     * Optional. Message is a general file, information about the file
     */
    public Document $document;

    /**
     * @var PhotoSize[]
     * Optional. Message is a photo, available sizes of the photo
     */
    #[ArrayOfDTO(PhotoSize::class)]
    public array $photo;

    /**
     * @var Sticker
     * Optional. Message is a sticker, information about the sticker
     */
    public Sticker $sticker;

    /**
     * @var Video
     * Optional. Message is a video, information about the video
     */
    public Video $video;

    /**
     * @var VideoNote
     * Optional. Message is a video note, information about the video message
     */
    public VideoNote $video_note;

    /**
     * @var Voice
     * Optional. Message is a voice message, information about the file
     */
    public Voice $voice;

    /**
     * @var String
     * Optional. Caption for the animation, audio, document, photo, video or voice
     */
    public string $caption;

    /**
     * @var MessageEntity[]
     * Optional. For messages with a caption, special entities like usernames, URLs,
     * bot commands, etc. that appear in the caption
     */
    #[ArrayOfDTO(MessageEntity::class)]
    public array $caption_entities;

    /**
     * @var Contact
     * Optional. Message is a shared contact, information about the contact
     */
    public Contact $contact;

    /**
     * @var Dice
     * Optional. Message is a dice with random value
     */
    public Dice $dice;

    /**
     * @var Game
     * Optional. Message is a game, information about the game.
     */
    public Game $game;

    /**
     * @var Poll
     * Optional. Message is a native poll, information about the poll
     */
    public Poll $poll;

    /**
     * @var Venue
     * Optional. Message is a venue, information about the venue.
     * For backward compatibility, when this field is set, the location field will also be set
     */
    public Venue $venue;

    /**
     * @var Location
     * Optional. Message is a shared location, information about the location
     */
    public Location $location;

    /**
     * @var User[]
     * Optional. New members that were added to the group
     * or supergroup and information about them (the bot itself may be one of these members)
     */
    #[ArrayOfDTO(User::class)]
    public array $new_chat_members;

    /**
     * @var User
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     */
    public User $left_chat_member;

    /**
     * @var string
     * Optional. A chat title was changed to this value
     */
    public string $new_chat_title;

    /**
     * @var PhotoSize[]
     * Optional. A chat photo was change to this value
     */
    #[ArrayOfDTO(PhotoSize::class)]
    public array $new_chat_photo;

    /**
     * @var bool
     * Optional. Service message: the chat photo was deleted
     */
    public bool $delete_chat_photo;

    /**
     * @var bool
     * Optional. Service message: the group has been created
     */
    public bool $group_chat_created;

    /**
     * @var bool
     * Optional. Service message: the supergroup has been created.
     * This field can't be received in a message coming through updates,
     * because bot can't be a member of a supergroup when it is created.
     * It can only be found in reply_to_message if someone replies to a very
     * first message in a directly created supergroup.
     */
    public bool $supergroup_chat_created;

    /**
     * @var bool
     * Optional. Service message: the channel has been created.
     * This field can't be received in a message coming through updates,
     * because bot can't be a member of a channel when it is created.
     * It can only be found in reply_to_message if someone replies to a very first message in a channel.
     */
    public bool $channel_chat_created;

    /**
     * @var MessageAutoDeleteTimerChanged
     * Optional. Service message: auto-delete timer settings changed in the chat
     */
    public MessageAutoDeleteTimerChanged $message_auto_delete_timer_changed;

    /**
     * @var int
     * Optional. The group has been migrated to a supergroup with the specified identifier.
     * This number may have more than 32 significant bits and some programming languages
     * may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits,
     * so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     */
    public int $migrate_to_chat_id;

    /**
     * @var int
     * Optional. The supergroup has been migrated from a group with the specified identifier.
     * This number may have more than 32 significant bits and some programming languages
     * may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits,
     * so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     */
    public int $migrate_from_chat_id;

    /**
     * @var Message
     * Optional. Specified message was pinned. Note that the Message object in this field will
     * not contain further reply_to_message fields even if it is itself a reply.
     */
    public Message $pinned_message;

    /**
     * @var Invoice
     * Optional. Message is an invoice for a payment, information about the invoice.
     */
    public Invoice $invoice;

    /**
     * @var SuccessfulPayment
     * Optional. Message is a service message about a successful payment,
     * information about the payment.
     */
    public SuccessfulPayment $successful_payment;

    /**
     * @var string
     * Optional. The domain name of the website on which the user has logged in.
     */
    public string $connected_website;

    /**
     * @var PassportData
     * Optional. Telegram Passport data
     */

    public PassportData $passport_data;

    /**
     * @var ProximityAlertTriggered
     * Optional. Service message. A user in the chat triggered another user's
     * proximity alert while sharing Live Location.
     */
    public ProximityAlertTriggered $proximity_alert_triggered;

    /**
     * @var VideoChatScheduled
     * Optional. Service message: video chat scheduled
     */
    public VideoChatScheduled $video_chat_scheduled;

    /**
     * @var VideoChatStarted
     * Optional. Service message: video chat started
     */
    public VideoChatStarted $video_chat_started;

    /**
     * @var VideoChatEnded
     * Optional. Service message: video chat ended
     */
    public VideoChatEnded $video_chat_ended;

    /**
     * @var VideoChatParticipantsInvited
     * Optional. Service message: new participants invited to a video chat
     */
    public VideoChatParticipantsInvited $video_chat_participants_invited;

    /**
     * @var WebAppData
     * Optional. Service message: data sent by a Web App
     */
    public WebAppData $web_app_data;

    /**
     * @var InlineKeyboardMarkup
     * Optional. Inline keyboard attached to the message. login_url
     * buttons are represented as ordinary url buttons.
     */
    public InlineKeyboardMarkup $reply_markup;
}