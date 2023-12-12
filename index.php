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
           'text' => 'Salom hush keldingiz',
        //    'reply_markup' => [
        //        'resize_keyboard' => true,
        //        'keyboard' => [
        //             [
        //                 ['text' => 'Salom'],
        //                 ['text' => 'Keyboard'],
        //             ],
        //             [
        //                 ['text' => 'Photo'],
        //                 ['text' => 'Inline Keyboard'],
        //             ],
        //        ]
        //    ]
        ];
        break;


    // case 'Inline Keyboard':
    //     $method = 'sendMessage';
    //     $send_data = [
    //         'text' => 'Salom '.$message['chat']['first_name'].PHP_EOL.'Inlene Keyboards 👇🏻👇🏻👇🏻',
    //         'reply_markup' => [
    //             'inline_keyboard' => [
    //                 [
    //                     ['text' => 'Google', 'url'=>'https://google.com'],
    //                     ['text' => 'Facebook', 'url'=>'https://facebook.com'],
    //                 ],
    //                 [
    //                     ['text' => 'YouTube', 'url'=>'https://youtube.com'],
    //                 ],
    //             ]
    //         ]
    //     ];
    //     break;
    // case 'Photo':
    //     $method = 'sendPhoto';
    //     $send_data = [
    //         'reply_to_message_id'=>$message['message_id'],
    //         'caption' => 'Bu rasm',
    //         'photo' => 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fimage.shutterstock.com%2Fimage-photo%2Fgrass-flowers-during-sunset-shadow-260nw-1267603696.jpg&imgrefurl=https%3A%2F%2Fwww.shutterstock.com%2Fsearch%2Fnew%2Bpic&tbnid=GiYrwvp35YEvEM&vet=12ahUKEwidlMfe2o7uAhUMtyoKHTEPCkEQMygCegUIARCaAQ..i&docid=Q9FVIInmXcXD0M&w=390&h=280&q=pic&ved=2ahUKEwidlMfe2o7uAhUMtyoKHTEPCkEQMygCegUIARCaAQ',
    //     ];
    //     break;
    // case 'Keyboard':
    //     $method = 'sendMessage';
    //     $send_data = [
    //         'text' => 'Keyboardlar o\'zgartirildi',
    //         'reply_markup' => [
    //             'resize_keyboard' => true,
    //             'keyboard' => [
    //                 [
    //                     ['text' => 'Ortga'],
    //                 ],
    //                 [
    //                     ['text' => 'Ortga'],
    //                     ['text' => 'Ortga'],
    //                 ],
    //                 [
    //                     ['text' => 'Ortga'],
    //                     ['text' => 'Ortga'],
    //                     ['text' => 'Ortga'],
    //                 ],
    //                 [
    //                     ['text' => 'Ortga'],
    //                     ['text' => 'Ortga'],
    //                     ['text' => 'Ortga'],
    //                     ['text' => 'Ortga'],
    //                 ],
    //             ]
    //         ]
    //     ];
    //     break;
    // case 'Ortga':
    //     $method = 'sendMessage';
    //     $send_data = [
    //         'text' => 'Ortga qaytildi',
    //         'reply_markup' => [
    //             'resize_keyboard' => true,
    //             'keyboard' => [
    //                 [
    //                     ['text' => 'Salom'],
    //                     ['text' => 'Keyboard'],
    //                 ],
    //                 [
    //                     ['text' => 'Photo'],
    //                     ['text' => 'Inline Keyboard'],
    //                 ],
    //            ]
    //         ]
    //     ];
    //     break;
    default:
        $method = 'sendMessage';
        $send_data = [
            'text' => 'Men sizni tushunganim yo\'q 🤷🏻‍♂️',
        ];

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
