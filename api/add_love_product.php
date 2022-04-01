<?//print_r(header('Content-Type: application/json'));
require "common.php";
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
$url .= '/index.php?route=api/custom/love_products&number='.$_GET['telephone'].'&product_id='.$_GET['product_id'];
$fields=['product_id'];
$json = do_curl_request($url, $fields);
?>
<?



$fields = json_decode($json,true);
if($fields['users']['wishlist']=='N;'||$fields['users']['wishlist']==""){
    $fields['users']['wishlist']='a:0:{}';
}
$pieces =$fields;
//print_r($pieces);
$pieces=unserialize($pieces['users']['wishlist'])
?>

    <?

    //print_r($pieces);
if (in_array($_GET['product_id'],$pieces)) {
    $result=[];
    $result['status']='error';
    header('Content-Type: application/json');
    print_r(json_encode($result));
    exit;
}
    array_push($pieces,intval($_GET['product_id']));
    $pieces=array_values($pieces);
 //  print_r($pieces);
    $pieces=serialize($pieces);
   //print_r($pieces);
    ?>

<?php

$url = $new_url.'/index.php?route=api/custom/add_love_product';
$data = array('telephone' => $_GET['telephone'],'wishlist'=>$pieces);

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
    $result=[];
    $result['status']='success';
}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$url = $new_url.'/api/get_love_products.php?number='.$_GET['telephone'];
$data = array();

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
    print_r($result);
}

