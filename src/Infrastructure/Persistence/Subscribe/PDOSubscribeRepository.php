<?php

namespace App\Infrastructure\Persistence\Subscribe;

use \App\Domain\Subscribe\SubscribeRepository;

class PDOSubscribeRepository implements SubscribeRepository {

    private function sendmessage($text) {
        $tg_user = '-1001419440380'; // id пользователя, которому отправиться сообщения
        $bot_token = '948518316:AAELEJXV4bOPsAnacXsMaUSd_GAr4ywDSCw'; // токен бота

        // file_get_contents('https://api.telegram.org/bot' . $bot_token . '/sendMessage?chat_id=' . $tg_user . "&parse_mode=HTML&text=" . urlencode($text));

        ///*
        // $params = array(
        //    'chat_id' => $tg_user,
        //    'text' => $text,
        //    'parse_mode' => 'HTML',
        //);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $bot_token . '/sendMessage?chat_id=' . $tg_user . "&text=" . urlencode($text));
        // curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($curl);
        curl_close($curl);

        // throw new Exception("$result");
        // */
    }

    /**
     * @throws Exception
     */
    public function subscribe($name, $phone, $auto_mark, $auto_vin, $auto_number, $works): int {
        $id = rand(0, 10000000);

        $auto_vin = $auto_vin == null ? "Не указан" : $auto_vin;
        $auto_number = $auto_number == null ? "Не указан" : $auto_number;

        $this->sendmessage("#id$id\nИмя: $name\nТелефон: $phone\nМарка авто: $auto_mark\nVIN авто: $auto_vin\nНомер авто: $auto_number\nОписание работ:\n<pre>$works</pre>");

        // throw new Exception("$name, $email, $phone, $auto_mark, $auto_model, $description");

        return $id;
    }
}
