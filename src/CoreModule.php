<?php

declare(strict_types=1);

namespace ekshop\ekshopSdk;
use InvalidArgumentException;
use mysql_xdevapi\Exception;


class CoreModule
{
    /**
     * @var array
     */
    protected $values = [];


    /**
     * @var string
     */
    protected $config_api_url = null;

    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        include('config.php');
        $this->config_api_url = $api_url ;
        // constructor body
    }

    /**
     * Add Proudct
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    public function addProduct(array $phrase,$token)
    {
        $validate = $this->validate($phrase);

        if ($validate === true){


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->config_api_url."partner/addProduct",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($phrase),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "x-auth-token: $token"
                ),
            ));

            $response = curl_exec($curl);
            $response_parsed = json_decode($response);
            curl_close($curl);
            try {
                $status = @$response_parsed->status;
                if ($status != 1){
                    throw new InvalidArgumentException(@$response_parsed->message);
                }
                return $response_parsed->product;

            }catch (Exception $exception){
                throw new InvalidArgumentException('Invalid Body');
            }

        }else{
            throw new InvalidArgumentException('Required option not passed or the format is incorrect !');
        }

        return $phrase;
    }

    /**
     * Validate Product add
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */

    public function validate(array $variables): bool
    {
        if (empty($variables['name'])) {
            throw new InvalidArgumentException('Required option not passed: "name"');
        }

        if (empty($variables['category'])) {
            throw new InvalidArgumentException('Required option not passed: "category"');
        }
        if (empty($variables['product_description'])) {
            throw new InvalidArgumentException('Required option not passed: "product_description"');
        }

        if (empty($variables['attributes'])) {
            throw new InvalidArgumentException('Required option not passed: "attributes"');
        }

        if (empty($variables['sku_information'])) {
            throw new InvalidArgumentException('Required option not passed: "sku_information"');
        }

        return  true;
    }


    /**
     * Login Session
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    public function listProduct(array $filters,$token)
    {

        $curl = curl_init();
        $final = $this->config_api_url . "partner/getProductList?" . http_build_query($filters);


        curl_setopt_array($curl, array(
            CURLOPT_URL => $final,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "x-auth-token: $token"
            ),
        ));

            $response = curl_exec($curl);
            $response_parsed = json_decode($response);
            curl_close($curl);
            try {
                $status = @$response_parsed->status;
                if ($status != 1){
                    throw new InvalidArgumentException(@$response_parsed->message);
                }
                return $response_parsed->products;

            }catch (Exception $exception){
                throw new InvalidArgumentException('Invalid Body');
            }


    }
}
