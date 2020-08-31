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


/*Product Add Bulk*/
$file_path = dirname(__DIR__,1).'/partner-bulk-product-sample.csv';
$product_add_bulk = $skeleton->addProductBulk($file_path,$token);

echo '<pre>';
print_r($product_add_bulk);
echo '</pre>';


/*[Change Products Status]*/
$product_reference_ids = ['000000'];
/*Publish A Product*/
$publish_product = $skeleton->productPublish($product_reference_ids,$token);

/*Un Publish A Product*/
$unpublish_product = $skeleton->productUnpublish($product_reference_ids,$token);

/*Draft A Product*/
$draft_product = $skeleton->productDraft($product_reference_ids,$token);

echo '<pre>';
print_r($draft_product);
echo '</pre>';


/*Production Deletetion*/
$product_reference_id = "000000";
$delete_product = $skeleton->productDelete($product_reference_id,$token);
echo '<pre>';
print_r($delete_product);
echo '</pre>';


/*Production Sku Deletetion*/
$product_reference_id = "000000";
$sku_id = "SKU-12549";  //get it from sku want to delete .
$delete_product_sku = $skeleton->productSkuDelete($product_reference_id,$sku_id,$token);
echo '<pre>';
print_r($delete_product_sku);
echo '</pre>';


/*Production Sku Deletetion*/
$payload['quantity']= 15;
$payload['price']= 555;
$payload['special_price']= 545;
$product_reference_id = "000000";
$sku_id = "SKU-12549";  //get it from sku want to delete .
$update_product_sku_inventory = $skeleton->productSkuInventoryUpdate($product_reference_id,$sku_id,$payload,$token);
echo '<pre>';
print_r($update_product_sku_inventory);
echo '</pre>';

