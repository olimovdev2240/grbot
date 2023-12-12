<?php
require 'vendor/autoload.php';

use Telegram\Bot\Api;

// Bot tokenni to'ldiring
$token = '6511859075:AAG_PJoc3rB7KcSywL_vFraJn6V35BDs1P4';

// Chat ID ni to'ldiring (chat1 guruhining ID si)
$chat1Id = '-1002076251830';

// Chat2 guruhining ID sini to'ldiring
$chat2Id = '-1002044782224';

// Telegram Bot API ga ulangan obyekt yaratish
$telegram = new Api($token);

// Chat1 guruhidagi xabarlarini olish
$response = $telegram->getChatAdministrators(['chat_id' => $chat1Id]);

// Chat2 guruhiga xabarlarini yuborish
foreach ($response as $admin) {
    $message = "Admin: @" . $admin->getUser()->getUsername() . " - " . $admin->getStatus();
    $telegram->sendMessage(['chat_id' => $chat2Id, 'text' => $message]);
}

// echo "Xabarlar yuborildi!";
