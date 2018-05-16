<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/5/14
 * Time: 下午5:05
 */

namespace App\Services;


use App\Services\DataType\ResponseHeaderMetadata;
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
    protected $userAgent = 'FBAInventoryServiceMWS PHP5 Library';

    /**
     * MWS constructor.
     * @param $serviceVersion
     */
    public function __construct($serviceVersion)
    {
        $this->setServiceUrl();
        $this->serviceVersion = $serviceVersion;
        $this->serviceUrl = $this->getServiceUrl();
        $this->setUserAgentHeader('online store by laravel', 'dev0.1', $attributes = null);
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
        $parameters['AWSAccessKeyId'] = config('amazon.aws_access_key_id');;
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

    /**
     * @param array $parameters
     * @return FBAInboundServiceMWSException|string
     */
    protected function invoke(array $parameters)
    {
            if (empty($this->getServiceUrl())) {
                return new FBAInboundServiceMWSException(
                    array ('ErrorCode' => 'InvalidServiceURL',
                           'Message' => "Missing serviceUrl configuration value. You may obtain a list of valid MWS URLs by consulting the MWS Developer's Guide, or reviewing the sample code published along side this library."));
            }
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
            info(Psr7\str($e->getRequest()));
            if ($e->hasResponse()) {
                info(Psr7\str($e->getResponse()));
            }
        }
    }
}