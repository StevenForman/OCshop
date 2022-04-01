<?php
require "common.php";
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
$data=json_decode($_POST['json'],true);
$telephone = $data['customer']['phone'];
$url .= '/index.php?route=api/custom/login_test&telephone='.$telephone;
$fields=[''];
$json = do_curl_request($url, $fields);
?>
<?
$json=json_decode($json,true);
?>

<?php
$items_id=[];
foreach ($data['items'] as $item){
    array_push($items_id,$item);
}
$items = serialize($items_id);

//?>
<!---->
<!--    --><?//
  //print_r($json);
    $telephone=$json['telephone'];
    $customer_id = $json['customer_id'];
    $firstname = $json['customer_id'];
    $lastname = $json['customer_id'];
    $email = $json['customer_id'];
//    ?>
<!---->
<?php

$url = $new_url.'/index.php?route=api/custom/add_order';
$data = array(
    'telephone'=>$telephone,
    'items'=>$items,
);

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
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
print_r($result);
