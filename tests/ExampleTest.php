<?php
require_once( dirname(__DIR__,3)."../../vendor/autoload.php");

/*Core Model*/
$skeleton = new \ekshop\ekshopSdk\CoreModule();


/*New Login Credentials*/
$new_login = array();
$new_login['login_id'] = "sdk@ekshop.com";
$new_login['password'] = "123456";
$new_login['device_id'] = "123465";
$new_login['device_token'] = "f4as4f5as5f4as5457";
$new_login['device_type'] = "PC";
$new_login['os'] = "windows";

/*Get Token and save into anywhere for future usage*/
$new_token = new \ekshop\ekshopSdk\AccessToken($new_login);
$token = $new_token->getToken();




/*Product Add*/
$json_url = 'http://localhost:8015/ekshopSdkImp/sample-product.json';
$json_load = file_get_contents($json_url);
$json_decoded = json_decode($json_load, true);

$product_add = $skeleton->addProduct($json_decoded,$token);

echo '<pre>';
print_r($product_add);
echo '</pre>';



/*List Product*/
$filters['page'] = 1;
$filters['limit'] = 10;
$filters['search_string'] = '';
$filters['merchant_type'] = '';
$filters['store_id'] = '';
$filters['status'] = '';
$filters['publish_status'] = '';
$filters['sort_by_sell'] = '';
$filters['sort_by_price'] = '';

$product_lists = $skeleton->listProduct($filters,$token);
echo '<pre>';
print_r($product_lists);
echo '</pre>';

