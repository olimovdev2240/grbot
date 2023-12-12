<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

$botToken = "6511859075:AAG_PJoc3rB7KcSywL_vFraJn6V35BDs1P4";
$chat1GroupId = -1002076251830;
$chat2GroupId = -1002044782224;

$telegram = new Api($botToken);

function processUpdate($update)
{
    global $telegram, $chat1GroupId, $chat2GroupId;

    $message = $update->getMessage();
    $chatId = $message->getChat()->getId();
    $userId = $message->getFrom()->getId();

    // Foydalanuvchi admin emas
    if (!$telegram->getChatMember([
        'chat_id' => $chat1GroupId,
        'user_id' => $userId,
    ])->isAdministrator()) {
        // Foydalanuvchiga "Sizga tezda bog'lanamiz" xabari yuboriladi
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "Sizga tezda bog'lanamiz",
        ]);

        // Xabarni chat2 guruhiga forward qilish
        $telegram->forwardMessage([
            'chat_id' => $chat2GroupId,
            'from_chat_id' => $chatId,
            'message_id' => $message->getMessageId(),
        ]);

        // Xabarni o'chirib tashlash
        $telegram->deleteMessage([
            'chat_id' => $chatId,
            'message_id' => $message->getMessageId(),
        ]);
    }
}

$updates = $telegram->getUpdates();

foreach ($updates as $update) {
    processUpdate($update);
}
