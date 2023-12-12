<?php
$params = [
    'token' => '6511859075:AAG_PJoc3rB7KcSywL_vFraJn6V35BDs1P4', #token
    'bot_url' => 'https://api.telegram.org/bot',
];


// ========== webhook =========
 $request = json_decode(file_get_contents('php://input'), TRUE);
// ========== webhook =========


$message = $request['message'];



switch($message['text']){
    case '/start':
        $method = 'sendMessage';
        $send_data = [
           'text' => '<pre>'.$message.'</pre>',
        ];
        break;

}

$send_data['chat_id'] = $message['chat']['id'];

sendTelegram($params, $method, $send_data);



function sendTelegram($params, $method, $data=[], $headers=[]){
    $curl = curl_init();

    curl_setopt_array($curl,[
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $params['bot_url'].$params['token'].'/'.$method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array_merge(["Content-Type: application/json"], $headers)

    ]);

    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result,1) ?: $result;
}
