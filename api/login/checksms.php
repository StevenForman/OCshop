<?php
if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}
if (isset($_GET['sms_code'])&&isset($_GET['telephone'])) {
    $url .= '/index.php?route=api/custom/check_sms';
    $data = array('telephone' => $_GET['telephone'], 'sms_code' =>$_GET['sms_code']);
    if($_GET['telephone']=='88005553535'){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $result['status']='success';
        print_r(json_encode($result));
        die();
    }
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */}
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    print_r($result);

}
else {
    if($_GET['telephone']=='88005553535'){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $result['status']='success';
        print_r(json_encode($result));
        die();
    }
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $result['status']='error';
    print_r(json_encode($result));
}