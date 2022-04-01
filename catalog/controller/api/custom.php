<?php

// catalog/controller/api/custom.php
class ControllerApiCustom extends Controller
{

    public function add_order()
    {
        $this->load->language('api/custom');
        $json = array();
        // load model
        $this->load->model('account/order');
        $products = $this->model_account_order->addOrder();
        $json['status'] = 'success';
        $json['order_id']=$products;

        $this->load->model('checkout/order');
        $test = $this->model_checkout_order->send_email($json['order_id']);
        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }
    public function add_love_product()
    {
        $this->load->model('account/customer');
        $wishlist = $_POST['wishlist'];
        $telephone = $_POST['telephone'];
        $users = $this->model_account_customer->add_love_product($wishlist,$telephone);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($users));
        return $users;
    }


    public function delete_love_product()
    {
        $this->load->model('account/customer');
        $wishlist = $_POST['wishlist'];
        $telephone = $_POST['telephone'];
        $users = $this->model_account_customer->delete_love_product($wishlist,$telephone);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($users));
        return $users;
    }

    public function check_sms()
    {
        $this->load->model('account/customer');
        $sms_code = $_POST['sms_code'];
        $telephone = $_POST['telephone'];
        $users = $this->model_account_customer->check_sms($sms_code,$telephone);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($users));
        return $users;
    }

    public function new_sms()
    {
        $sms_code = $_POST['$sms_code'];
        $telephone = $_POST['telephone'];
        $name=$_POST['name'];
        $this->load->model('account/customer');
        $users = $this->model_account_customer->getCustomerByTelephone($telephone);
        if (isset($users['customer_id'])) {
            $this->load->model('account/customer');
            $users = $this->model_account_customer->new_sms($sms_code,$telephone);
            header('Access-Control-Allow-Origin: *');
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($users));
            return $users;
        }
        else {
            $this->load->model('account/customer');
            $users = $this->model_account_customer->new_customer($sms_code,$telephone,$name);
            header('Access-Control-Allow-Origin: *');
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($users));
            return $users;
        }

    }
    public function generate_token()
    {
        $this->load->model('account/customer');
        $token = $_POST['mobile_token'];
        $telephone = $_POST['telephone'];
        $users = $this->model_account_customer->generate_token($token,$telephone);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($users));
        return $users;
    }

    public function check_token()
    {
        $this->load->model('account/customer');
        $token = $_POST['mobile_token'];
        $users = $this->model_account_customer->check_token($token);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($users));
        return $users;
    }


    public function login_test()
    {
        $telephone = $_GET['telephone'];
        $this->load->model('account/customer');
        $users = $this->model_account_customer->getCustomerByTelephone($telephone);


        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($users));
        return $users;
    }

    public function addfromurl()
    {
        $this->load->language('api/cart');

        $json = array();
        // load model
        $this->load->model('api/cart');
        $users = $this->model_api_cart->addfromurl();
        $json = $users;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }


    public function love_products()
    {
        $number = $_GET['number'];
        $this->load->language('api/custom');

        $json = array();
        // load model
        $this->load->model('account/customer');
        $users = $this->model_account_customer->getCustomers($number);
        $json['status'] = 'success';
        $json['users'] = $users;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }


    public function getOr()
    {
        $number = $_GET['telephone'];
        $this->load->language('api/custom');

        $json = array();
        // load model
        $this->load->model('account/order');
        $products = $this->model_account_order->getOr($number);
        $json['status'] = 'success';
        $json['orders'] = $products;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function get_product()
    {
        $number = $_GET['id'];
        $this->load->language('api/custom');

        $json = array();
        // load model
        $this->load->model('catalog/product');
        $products = $this->model_catalog_product->getProductTT($number);
        $json['status'] = 'success';
        $json['products'] = $products;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function sales()
    {
        $this->load->language('api/custom');
        $json = array();
        $this->load->model('catalog/product');
        $orders = $this->model_catalog_product->sales();
        $json['status'] = 'success';
        $json['banners'] = $orders;
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

    }

    public function banners()
    {
        $this->load->language('api/custom');
        $json = array();
        $this->load->model('catalog/product');
        $orders = $this->model_catalog_product->banners();
        $json['status'] = 'success';
        $json['sales'] = $orders;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

    }
    public function get_orders()
    {
        $number = $_GET['number'];
        $this->load->language('api/custom');

        $json = array();
        // load model
        $this->load->model('account/order');
        $orders = $this->model_account_order->getOrdersByNumber($number);
        $json['status'] = 'success';
        $json['orders'] = $orders;
        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }


    public function products()
    {

        $this->load->language('api/custom');

        $json = array();

        // load model
        $this->load->model('catalog/product');
        // get products
        $products = $this->model_catalog_product->getProducts();
        $json['status'] = 'success';
        $json['products'] = $products;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function products_category()
    {
        $id = $_GET['category_id'];
        $this->load->language('api/custom');

        $json = array();
        // load model
        $this->load->model('catalog/product');
        $products = $this->model_catalog_product->getProductsByCategoryId($id);
        $json['status'] = 'success';
        $json['products'] = $products;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function category()
    {

        $this->load->language('api/custom');

        $json = array();
        // load model
        $this->load->model('catalog/category');
        // get category
        $categories = $this->model_catalog_category->getCategories();
        $json['success'] = "success";
        $json['categories'] = $categories;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function coupons()
    {

        $this->load->language('api/custom');

        $json = array();


        // load model
        $this->load->model('checkout/coupon');
        $this->load->model('catalog/product');

        $this->isApiCall = true;
        // get category
        $categories = $this->model_checkout_coupon->getCoupon($_GET['code'], $_GET['phone']);
        $json['status'] = 'success';
        $json['coupon'] = $categories;
        if(isset($json['coupon']['coupon_id'])){
            $json['status'] = 'success';
            $json['coupon'] = $categories;

            if(isset($json['coupon']['free_product']) && !empty($json['coupon']['free_product'])) {
                $free_product_ids = $json['coupon']['free_product'];
                $free_product_array = array();

                foreach($free_product_ids as $product_id) {
                    $free_product = $this->model_catalog_product->getProductTT($product_id);

                    if($free_product) {
                        $free_product['price'] = "0"; // Just in case
                        $free_product_array[] = $free_product;
                    }
                }

                $json['coupon']['free_product'] = $free_product_array;
            }
        }
        else {
            $json=[];
            $json['status'] = 'error';
        }

        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function information()
    {

        $this->load->language('api/custom');

        $json = array();


        // load model
        $this->load->model('catalog/information');
        // get category
        $information = $this->model_catalog_information->getInformations();
        $json['success'] = 'success';
        $json['information'] = $information;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function blog()
    {

        $this->load->language('api/custom');

        $json = array();


        if (!isset($this->session->data['api_id'])) {

            $json['error']['warning'] = $this->language->get('error_permission');

        } else {

            // load model
            $this->load->model('bossblog/articles');
            // get category
            $blog = $this->model_bossblog_articles->getArticles();
            $json['success'] = $blog;

        }


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }

    public function info()
    {

        $this->load->language('api/custom');

        $json = array();


        // load model
        $this->load->model('catalog/information');
        // get category
        $info = $this->model_catalog_information->getInfo();
        $json['success'] = 'success';
        $json['information'] = $info;


        if (isset($this->request->server['HTTP_ORIGIN'])) {

            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);

            $this->response->addHeader('Access-Control-Allow-Methods: GET');

            $this->response->addHeader('Access-Control-Max-Age: 1000');

            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        }


        $this->response->addHeader('Content-Type: application/json');

        $this->response->setOutput(json_encode($json));

    }
}
