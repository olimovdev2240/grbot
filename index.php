<?php
// Telegram Bot API tokeni
$botToken = "6511859075:AAG_PJoc3rB7KcSywL_vFraJn6V35BDs1P4";
// chat1 guruh IDsi
$chat1GroupId = -1002076251830;
// chat2 guruh IDsi
$chat2GroupId = -1002044782224;

// Telegram Bot API so'rov yuborish uchun asosiy manzil
$apiUrl = "https://api.telegram.org/bot6511859075:AAG_PJoc3rB7KcSywL_vFraJn6V35BDs1P4";

// Chat1 guruhidagi administratorlarni olish
$admins = getChatAdministrators($chat1GroupId);

// Chat1 guruhidagi administratorlarning IDlarini olamiz
$adminIds = array();
foreach ($admins as $admin) {
    $adminIds[] = $admin['user']['id'];
}

// Chat1 guruhidagi xabarlarni olish va chat2 guruhiga yuborish
$updates = getGroupMessages($chat1GroupId);

foreach ($updates as $update) {
    $message = $update['message'];
    $userId = $message['from']['id'];

    // Faqat guruh administratorlarining xabarlari chat2 guruhiga yuboriladi
    if (in_array($userId, $adminIds)) {
        forwardMessage($chat2GroupId, $chat1GroupId, $message['message_id']);
    }
}

// Chatdagi administratorlarni olish
function getChatAdministrators($chatId) {
    global $apiUrl;
    $url = "$apiUrl/getChatAdministrators?chat_id=$chatId";
    $response = file_get_contents($url);
    $result = json_decode($response, true);
    return $result['result'];
}

// Guruhdagi xabarlarni olish
function getGroupMessages($chatId) {
    global $apiUrl;
    $url = "$apiUrl/getUpdates?offset=-1&limit=1&chat_id=$chatId";
    $response = file_get_contents($url);
    $result = json_decode($response, true);
    return $result['result'];
}

// Xabarni boshqa guruhga yuborish
function forwardMessage($toChatId, $fromChatId, $messageId) {
    global $apiUrl;
    $url = "$apiUrl/forwardMessage?chat_id=$toChatId&from_chat_id=$fromChatId&message_id=$messageId";
    file_get_contents($url);
}
?>
