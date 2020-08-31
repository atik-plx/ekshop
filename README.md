# ekshopSdk

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** 

This is a product of ekshop. Collect account from Ekshop team and test the sdk for implementation.

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practices by being named the following.

```
src/
tests/
```


## Install

Via Composer

``` bash
$ composer require ekshop/ekshopSdk
```

## Usage

``` php
/*New Login Credentials*/
$new_login = array();
$new_login['login_id'] = "";
$new_login['password'] = "";
$new_login['device_id'] = "";
$new_login['device_token'] = "";
$new_login['device_type'] = "";
$new_login['os'] = "";

/*Get Token and save into anywhere for future usage*/
$new_token = new \ekshop\ekshopSdk\AccessToken($new_login);
$token = $new_token->getToken();


/*Product Add*/
$json_url = 'https://raw.githubusercontent.com/atik-plx/ekshop/master/sample-product.json';
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
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ php tests/ExampleTest.php
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ekshop@ekshop.gov.bd instead of using the issue tracker.

## Credits

- [Ekshop][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ekshop/ekshopSdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ekshop/ekshopSdk/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ekshop/ekshopSdk.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ekshop/ekshopSdk.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ekshop/ekshopSdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ekshop/ekshopSdk
[link-travis]: https://travis-ci.org/ekshop/ekshopSdk
[link-scrutinizer]: https://scrutinizer-ci.com/g/ekshop/ekshopSdk/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ekshop/ekshopSdk
[link-downloads]: https://packagist.org/packages/ekshop/ekshopSdk
[link-author]: https://github.com/ekshop
[link-contributors]: ../../contributors
