<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/5/16
 * Time: 下午4:37
 */

namespace App\Services\Traits;


trait SignTrait
{
    protected function signParameters(array $parameters, $key,$serviceUrl)
    {
        $stringToSign = $this->calculateStringToSignV2($parameters,$serviceUrl);
        return $this->sign($stringToSign, $key);
    }

    private function sign($data, $key, $algorithm = 'HmacSHA256')
    {
        if ($algorithm === 'HmacSHA1') {
            $hash = 'sha1';
        } else if ($algorithm === 'HmacSHA256') {
            $hash = 'sha256';
        } else {
            throw new Exception ("Non-supported signing method specified");
        }
        return base64_encode(
            hash_hmac($hash, $data, $key, true)
        );
    }

    private function calculateStringToSignV2(array $parameters,$serviceUrl)
    {
        $data = 'POST';
        $data .= "\n";
        $endpoint = parse_url($serviceUrl);
        $data .= $endpoint['host'];
        $data .= "\n";
        $uri = array_key_exists('path', $endpoint) ? $endpoint['path'] : null;
        if ( !isset ($uri)) {
            $uri = "/";
        }
        $uriencoded = implode("/", array_map([ $this, "_urlencode" ], explode("/", $uri)));
        $data .= $uriencoded;
        $data .= "\n";
        uksort($parameters, 'strcmp');
        $data .= $this->getParametersAsString($parameters);
        return $data;
    }

    private function getParametersAsString(array $parameters)
    {
        return http_build_query($parameters);
//        $queryParameters = [];
//        foreach ($parameters as $key => $value) {
//            $queryParameters[] = $key . '=' . $this->_urlencode($value);
//        }
//        return implode('&', $queryParameters);
    }

    private function _urlencode($value) {
        return str_replace('%7E', '~', rawurlencode($value));
    }
}