<?php
require 'common.php';
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$url .= '/api/order/testjson.php';
$data = json_decode(file_get_contents("php://input"), true);
if(isset($data)){
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
if ($result === FALSE) { /* Handle error */ }
else {
//    $result=[];
//    $result['status']='success';
}
?>

    <?
    header('Content-Type: application/json');
    print_r($result);}
    ?>
