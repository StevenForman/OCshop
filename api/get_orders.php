<?//print_r(header('Content-Type: application/json'));
require "common.php";

if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
}

$telephone=$_GET['telephone'];
$url .= '/index.php?route=api/custom/getOr&telephone='.$telephone;
$fields=[''];
$json = do_curl_request($url, $fields);
?>
<?
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
?>

    <?
    $jw=(json_decode($json,true));
    ?>

    <?
    $out['status']='success';
    arsort($jw['orders']);
    $out['orders'] = array_values($jw['orders']);

    $out=json_encode($out);
    //print_r($jw['orders'])
    print_r($out);

    ?>



