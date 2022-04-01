<?php
require_once 'sms.ru.php';

if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
if (isset($_GET['mobile_token'])) {
    $url .= '/api/login/checktoken.php';
    $data = array('mobile_token' => $_GET['mobile_token']);

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
    }
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    print_r($result);
}
else{
    $result=["status"=>"error"];
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    print_r(json_encode($result));
}




