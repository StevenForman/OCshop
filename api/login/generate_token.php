<?php
require 'sms.ru.php';
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
function gen_token() {

    $bytes = openssl_random_pseudo_bytes(20, $cstrong);

    return bin2hex($bytes);

}

if (true) { // Запрос выполнен успешно
    $token = gen_token();

    $url .= '/index.php?route=api/custom/generate_token';
    $data = array('mobile_token' => $token,'telephone'=>$_GET['telephone']);

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $res = ["status"=>'success',"token"=>$token,'telephone'=>$_GET['telephone']];
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    print_r(json_encode($res));
}





