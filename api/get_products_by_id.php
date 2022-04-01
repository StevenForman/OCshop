<?
require "common.php";
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
if(isset($_GET['category_id'])){
    $url .= '/index.php?route=api/custom/products_category&category_id='.$_GET['category_id'];
    $fields=[];
    $json = do_curl_request($url, $fields);
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


    print_r($json);
}
else {
    $url = $new_url.'/index.php?route=api/custom/products';
    $fields=[];
    $json = do_curl_request($url, $fields);
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    print_r($json);

}
