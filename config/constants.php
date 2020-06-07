<?php


return [
    'notification' => [
        'friendship_request' => '1',
        'new_post' => '2',
        'post_reply' => '3',
        'comment_reply' => '4',
        'new_message' => '5',
    ],
    'role' => [
        'user' => '1',
        'editor' => '2',
        'admin' => '3',
    ],

    'post_visibility' => [
        'private' => '0',
        'friends' => '1',
        'all' => '2',
    ],

    'post_type' => [
        'text' => '0',
        'image' => '1',
        'video' => '2',
    ],

    'friendship.status' => [
        'unaccepted' => '0',
        'friends' => '1',
        'best_friends' => '2',
    ],
    'chat.status' => [
        'pinned' => '0',
        'normal' => '1',
        'archived' => '2',
    ],
    'message.status' => [
        'normal' => '1',
        'deleted' => '2',
    ],
    'message_type' => [
        'text' => '0',
        'image' => '1',
        'video' => '1',
    ],
    'action_type' => [
        'publish_post' => '0',
        'publish_comment' => '1',
        'create_chat' => '2',
        'send_message' => '3',
        'send_friendrequest' => '4',
        'accept_friendrequest' => '5',
        'remove_friend' => '6',
        'like_post' => '7',
        'like_comment' => '8',
    ],


];
