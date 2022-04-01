<?
require "common.php";
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
$code=$_GET['code'];
$phone=$_GET['phone'];
$url .= '/index.php?route=api/custom/coupons&code='.$code.'&phone='.$phone;
$fields=[];
$json = do_curl_request($url, $fields);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
if(!isset($json)){
    $json['status']='error';
}
print_r($json);