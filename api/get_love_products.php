<?//print_r(header('Content-Type: application/json'));
require "common.php";

if (isset($_SERVER['HTTPS_HOST'])) {
    $url = 'https://' . $_SERVER['HTTPS_HOST'];
    $new_url = $url;
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $new_url = $url;
}


$url .= '/index.php?route=api/custom/love_products&number='.$_GET['number'];
$fields=['product_id'];
$json = do_curl_request($url, $fields);
$json_check = json_decode($json,true);
if(count($json_check['users'])<1){
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $a['status']='error';
    return print_r(json_encode($a));
}
?>
    <?
    $fields = json_decode($json,true);
    $test_fields = unserialize($fields['users']['wishlist']);
    if(isset($test_fields[0])){
    }
    else {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $a['status']='error';
        return print_r(json_encode($a));
    }
    if(!isset($fields['users']['wishlist'])){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $a['status']='error';
        return print_r(json_encode($a));
    }
    $pieces = explode("i:", $fields['users']['wishlist']);
    $count=count($pieces);
    $i=0;
    $array=[];
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
    while ($i<$count)
    {
        if($i%2==0&&$i>1){
            $result=[];
            $id = substr($pieces[$i],0,3).'<br>';
            $url = $new_url.'/index.php?route=api/custom/get_product&id='.$id;
            $fields=[''];
            $json = do_curl_request($url, $fields);
            $jarray = json_decode($json,true);
            $array=array_merge_recursive($array,$jarray);

        }
        $i++;
    }
?>

    <?
    $i=0;
    foreach ($array as $key=>$value){
        array_push($result,$key);
    }
    $a = array_fill_keys($result, []);

//    [name]
//    [description]
//    [meta_title]
//    [price]
//    [special]
//    [weight]
//    [image]

if(is_array(($array['products']['product_id']))){
    foreach ($array['products']['product_id']as $product) {
        $a['status']='success';
        $a['products'][$i]=['product_id'=>$product];
        $a['products'][$i]['name'] =$array['products']['name'][$i];
        $a['products'][$i]['description'] =$array['products']['description'][$i];
        $a['products'][$i]['meta_title'] =$array['products']['meta_title'][$i];
        $a['products'][$i]['price'] =$array['products']['price'][$i];
        $a['products'][$i]['special'] =$array['products']['special'][$i];
        $a['products'][$i]['weight'] =$array['products']['weight'][$i];
        $a['products'][$i]['image'] =$array['products']['image'][$i];
        $a['products'][$i]['big_image'] =$array['products']['big_image'][$i];
        $i++;
   }
    print_r(json_encode($a));
}
else {
    $a['status']='success';
    $a['products'][0]['product_id']=$array['products']['product_id'];
    $a['products'][0]['name'] =$array['products']['name'];
    $a['products'][0]['description'] =$array['products']['description'];
    $a['products'][0]['meta_title'] =$array['products']['meta_title'];
    $a['products'][0]['price'] =$array['products']['price'];
    $a['products'][0]['special'] =$array['products']['special'];
    $a['products'][0]['weight'] =$array['products']['weight'];
    $a['products'][0]['image'] =$array['products']['image'];
    $a['products'][0]['big_image'] =$array['products']['big_image'];
    print_r(json_encode($a));
}
//    foreach ($array['products']['product_id']as $product) {
//        $a['status']='success';
//        $a['products'][$i]=['id'=>$product];
//        $a['products'][$i]['name'] =$array['products']['name'][$i];
//        $a['products'][$i]['description'] =$array['products']['description'][$i];
//        $a['products'][$i]['meta_title'] =$array['products']['meta_title'][$i];
//        $a['products'][$i]['price'] =$array['products']['price'][$i];
//        $a['products'][$i]['special'] =$array['products']['special'][$i];
//        $a['products'][$i]['weight'] =$array['products']['weight'][$i];
//        $a['products'][$i]['image'] =$array['products']['image'][$i];
//        $i++;
//   }



    ?>



