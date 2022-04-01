<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
// print_r($data);
if(isset($_POST['message'])){
    $data = $_POST['message'];

}


/*else{
    $json['status']='error';
    return  print_r(json_encode($json));
}*/

?>


<?php
if (isset($data['message'])) {
    $to_arr = array(
        'report@webstripe.ru',
        'cru@webstripe.ru'
    );
    $subject = 'Техническая ошибка в приложении!';

    if(isset($data['phone'])) {
        $message = "Телефон для связи: " . $data['phone'] . "\n\n" . $data['message'];
    } else {
        $message = $data['message'];
    }

    $headers = 'From: ***' . "\r\n" .
        'Reply-To: ***' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    foreach($to_arr as $to) {
        if(mail($to, $subject, $message, $headers)){
            $json['status']='success';
        }
        else {
            $json['status']='error';
            break;
        }
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    print_r(json_encode($json));


}
else {
    $json['status']='error';
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    print_r(json_encode($json));
}


?>


