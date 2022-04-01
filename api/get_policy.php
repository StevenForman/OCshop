<?
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


require "common.php";
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
}

$url .= '/index.php?route=api/custom/information';
$fields=[''];
$json = do_curl_request($url, $fields);
print_r($json);
?>

