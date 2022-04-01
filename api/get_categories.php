<?
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
require "common.php";
$url .= '/index.php?route=api/custom/category';
$fields=[''];
$json = do_curl_request($url, $fields);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
print_r($json);

?>

