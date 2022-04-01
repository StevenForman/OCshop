<?
require "common.php";
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
$url .= '/index.php?route=api/custom/banners';
$fields=['product_id'];
$json = do_curl_request($url, $fields);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
print_r($json);