<?php
require 'sms.ru.php';
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
header('Access-Control-Allow-Origin: *');


$smsru = new SMSRU(''); // Ваш уникальный программный ключ, который можно получить на главной странице
$data = new stdClass();
$data->to = $_GET['telephone'];
if($_GET['telephone']==""){
    $res=[];
    header('Content-Type: application/json');
    $res['status']='error';
    echo json_encode($res);
    exit;
}
$rand = rand(1001, 9999);

$data->text = "Ваш код подтверждения - ".$rand; // Текст сообщения
$sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

if (true){
    $url .= '/index.php?route=api/custom/new_sms';
    $data = array('$sms_code' => $rand,'telephone'=>$_GET['telephone'],'name'=>$_GET['name']);

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if($result=='true'){
        header('Content-Type: application/json');
            $res['status']='success';
            $res['code']=$rand;
        echo json_encode($res);
    }
    else{
        $res=[];
        header('Content-Type: application/json');
        $res['status']='error';
        echo json_encode($res);
    }
}
