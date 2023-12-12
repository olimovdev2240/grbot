<?php
require 'vendor/autoload.php';

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

// Telegram Bot API tokeni
$botToken = "6511859075:AAG_PJoc3rB7KcSywL_vFraJn6V35BDs1P4";
// chat1 guruh IDsi
$chat1GroupId = -1002076251830;
// chat2 guruh IDsi
$chat2GroupId = -1002044782224;

// Telegram botini yaratamiz
$telegram = new Api($botToken);

// Chat1 guruhidagi administratorlarni olish
$admins = $telegram->getChatAdministrators(['chat_id' => $chat1GroupId]);

// Chat1 guruhidagi administratorlarning IDlarini olamiz
$adminIds = array_map(function ($admin) {
    return $admin->getId();
}, $admins);

// Chat1 guruhidagi xabarlarni forward qilish
$telegram->addCommand(\Telegram\Bot\Commands\HelpCommand::class);

$telegram->on(function ($update) use ($telegram, $chat1GroupId, $chat2GroupId, $adminIds) {
    $message = $update->getMessage();
    $userId = $message->getFrom()->getId();

    // Faqat guruh administratorlarining xabarlari chat2 guruhiga yuboriladi
    if (in_array($userId, $adminIds)) {
        // Forward qilish
        $telegram->forwardMessage([
            'chat_id' => $chat2GroupId,
            'from_chat_id' => $chat1GroupId,
            'message_id' => $message->getMessageId(),
        ]);
    }
}, function ($message) {
    return true;
});

$telegram->commandsHandler(true);
