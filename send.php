<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$_POST = json_decode(file_get_contents("php://input"), true);

if (!empty($_POST['phone'])) {

    $token = "5459897053:AAGlhf7igwaMGCdLFj-47o-XV5ZGAX03Ms0";

    $chat_id = "531630792";

    $name = ($_POST['name']);
    $phone = ($_POST['phone']);
    $comment = ($_POST['comment']);

    $arr = array(
        'Имя:' => $name,
        'Телефон:' => $phone,
        'Комментарий:' => $comment
    );

    foreach($arr as $key => $value) {
        $txt .= "<b>".$key."</b> ".$value."%0A";
    };

    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

    header('Content-Type: application/json; charset=utf-8');

    if ($sendToTelegram) {
        echo json_encode([
            'status' => true,
            'message' => 'Спасибо! Ваша заявка принята. Мы свяжемся с вами в ближайшее время.'
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Что-то пошло не так. Попробуйте отправить заявку позже. Или позвоните нам.'
        ]);
    }
}
