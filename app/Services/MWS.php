<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/5/14
 * Time: 下午5:05
 */

namespace App\Services;


use App\Services\Exception\FBAInboundServiceMWSException;
use App\Services\Facades\ServiceMWSUrlFacade;
use App\Services\Traits\SignTrait;
use App\Services\Traits\UserAgentHeaderTrait;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

/**
 * Class MWS
 * @package App\Services
 */
abstract class MWS implements ServiceMWSUrlFacade
{
    use SignTrait,UserAgentHeaderTrait;

    /**
     *
     */
    const MWS_CLIENT_VERSION = '2016-10-05';

    /**
     *
     */
    const SIGNATURE_METHOD = 'HmacSHA256';
    /**
     *
     */
    const SIGNATURE_VERSION = '2';

    /**
     * @var string
     */
    protected $serviceVersion = '2010-10-01';

    /**
     * @var null
     */
    protected $serviceUrl = null;

    /**
     * @var string
     */
    protected $userAgent = null;

    /**
     * 自定义请求参数
     * @var array
     */
    private $customRequestParams = [];

    /**
     * MWS constructor.
     * @param $serviceVersion
     * @param array $customRequestParams
     */
    public function __construct(string $serviceVersion,array $customRequestParams = [])
    {
        $this->setServiceUrl();
        $this->customRequestParams = $customRequestParams;
        $this->serviceVersion = $serviceVersion;
        $this->serviceUrl = $this->getServiceUrl();
        $this->setUserAgentHeader(config('amazon.app_name'), 'dev0.1', $attributes = null);
    }

    /**
     * @return mixed
     */
    protected function getServiceLocaleUrl()
    {
        return config('amazon.services_url')[config('amazon.service_locale')];
    }

    /**
     * @param array $parameters
     * @return array
     */
    private function addRequiredParameters(array $parameters = [])
    {
        $parameters['SellerId'] = config('amazon.seller_id');
//        $parameters['Merchant'] = config('amazon.merchant');
        $parameters['MWSAuthToken'] = config('amazon.auth_token');
        $parameters['AWSAccessKeyId'] = config('amazon.aws_access_key_id');
        $parameters['Timestamp'] = $this->getFormattedTimestamp();
        $parameters['Version'] = $this->serviceVersion;
        $parameters['SignatureVersion'] = self::SIGNATURE_VERSION;
        $parameters['SignatureMethod'] = self::SIGNATURE_METHOD;
        $parameters['Signature'] = $this->signParameters($parameters, config('amazon.aws_secret_access_key'),$this->getServiceUrl());
        return $parameters;
    }

    /**
     * @return false|string
     */
    private function getFormattedTimestamp()
    {
        return gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
    }


    protected function invoke(array $parameters)
    {
            if (empty($this->getServiceUrl())) {
                return new FBAInboundServiceMWSException(
                    array ('ErrorCode' => 'InvalidServiceURL',
                           'Message' => "Missing serviceUrl configuration value. You may obtain a list of valid MWS URLs by consulting the MWS Developer's Guide, or reviewing the sample code published along side this library."));
            }
            $parameters = array_merge($parameters,$this->customRequestParams);
            $parameters = $this->addRequiredParameters($parameters);
            return $this->httpPost($parameters);
    }

    /**
     * @param array $parameters
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function httpPost(array $parameters)
    {
        $headers['Content-Type'] = "application/x-www-form-urlencoded; charset=utf-8"; // We need to make sure to set utf-8 encoding here
        $headers['Expect'] = null; // Don't expect 100 Continue
        $headers['UserAgent'] = $this->userAgent;
        $client = new Client;
        try {
            $response = $client->request('POST', $this->getServiceUrl(),[
                'form_params'=>$parameters,
                'headers'=>$headers
            ]);
            return ((string)($response->getBody()));
        } catch (RequestException $e) {
            dd(Psr7\str($e->getResponse()));

//            if ($e->hasResponse()) {
//                //
//            }
        }
    }

    /**
     * @param $xml
     * @return mixed
     */
    public function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }
}