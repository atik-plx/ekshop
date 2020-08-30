<?php
/**
 * This file is part of the ekshopSdk; library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace ekshop\ekshopSdk;

use InvalidArgumentException;
use mysql_xdevapi\Exception;
use RuntimeException;


class AccessToken implements AccessTokenInterface
{
    /**
     * @var string
     */
    protected $login_id;

    /**
     * @var string
     */
    public $accessToken;

    /**
     * @var int
     */
    protected $password;

    /**
     * @var string
     */
    protected $device_id;

    /**
     * @var string
     */
    protected $device_token;

    /**
     * @var string
     */
    protected $device_type;

    /**
     * @var string
     */
    protected $os;

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @var string
     */
    protected $config_api_url = null;

    /**
     * Constructs an access token.
     *
     * @param array $options An array of options returned by the service provider
     *     in the access token request. The `access_token` option is required.
     * @throws InvalidArgumentException if `access_token` is not provided in `$options`.
     */
    public function __construct(array $options = [])
    {
        include('config.php');
        $this->config_api_url = $api_url ;

        if (empty($options['login_id'])) {
            throw new InvalidArgumentException('Required option not passed: "login_id"');
        }

        $this->login_id = $options['login_id'];

        if (empty($options['password'])) {
            throw new InvalidArgumentException('Required option not passed: "password"');
        }

        $this->password = $options['password'];



        $this->device_id = $options['device_id'];
        $this->device_token = $options['device_token'];
        $this->device_type = $options['device_type'];
        $this->os = $options['os'];

        // Capture any additional values that might exist in the token but are
        // not part of the standard response. Vendors will sometimes pass
        // additional user data this way.
        $this->values = $options;

    }

    /**
     * Check if a value is an expiration timestamp or second value.
     *
     * @param integer $value
     * @return bool
     */


    /**
     * @inheritdoc
     */
    public function getToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config_api_url."partner/getSession",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($this->values),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $response_parsed = json_decode($response);
        curl_close($curl);
        try {
            $user_login_session = @$response_parsed->user_login_session;
            if (empty($user_login_session)){
                throw new InvalidArgumentException('Invalid Credentails');
            }
            $this->accessToken = @$user_login_session->token;
            return $user_login_session->token;

        }catch (Exception $exception){
            throw new InvalidArgumentException('Invalid Credentails');
        }

    }


    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string) $this->getToken();
    }


}
