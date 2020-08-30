<?php
/**
 * This file is part of the ekshopSdk; library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace ekshop\ekshopSdk;


use RuntimeException;

interface AccessTokenInterface
{
    /**
     * Returns the access token string of this instance.
     *
     * @return string
     */
    public function getToken();

    /**
     * Returns the refresh token, if defined.
     *
     * @return string|null
     */


    /**
     * Returns a string representation of the access token
     *
     * @return string
     */
    public function __toString();

    /**
     * Returns an array of parameters to serialize when this is serialized with
     * json_encode().
     *
     * @return array
     */
}
