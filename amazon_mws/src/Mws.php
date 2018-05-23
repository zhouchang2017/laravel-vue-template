<?php

namespace Mws;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Mws\Traits\UserAgentHeaderTrait;

class Mws extends Client
{
    use UserAgentHeaderTrait;

    protected $collection;

    protected $operations;

    private $provider = 'amazon';

    private $appName;

    private $awsAccessKeyId;

    private $awsecretAccessKey;

    private $local;

    private $mwsAuthToken;

    private $sellerId;

    private $merchant;

    private $header;

    private $clientVersion;

    private $config;

    public function __construct(Collection $collection, $endpoint)
    {
        parent::__construct();
        $this->collection = $collection;
    }


    /**
     * 验证请求action是否存在
     * @param string $action
     * @return bool
     */
    public function actionIsValid(string $action)
    {
        $action = studly_case($action);
        return in_array($action, $this->collection->actions());
    }


    /**
     * 通过请求action，返回请求必要参数
     * @param string $action
     * @return array
     */
    public function getParams(string $action): array
    {
        $action = studly_case($action);
        if ($this->actionIsValid($action)) {
            return [
                'action'  => $action,
                'module'  => $this->collection->getModule($action),
                'version' => $this->collection->getVersion($action),
            ];
        }
        return [
            'action'  => $action,
            'module'  => 'Common',
            'version' => '2009-01-01',
        ];
    }

    public function setHeader()
    {
        $this->header['Content-Type'] = "application/x-www-form-urlencoded; charset=utf-8"; // We need to make sure to set utf-8 encoding here
        $this->header['Expect'] = null; // Don't expect 100 Continue
        $this->header['UserAgent'] = $this->getUserAgentHeader($this->appName, 'dev-v0.01');
    }

    public function preRequest($action, $query = [])
    {
        $params = $this->getParams($action);
        $this->setClientVersion($params['version']);
        $this->setHeader();
        return array_merge([
            'Action'  => $params['action'],
            'Version' => $params['version'],
        ], $query);
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

    private function httpRequest(array $parameters,$requestUrl)
    {

        try {
            $response = $this->request('POST', $requestUrl, [
                'form_params' => $parameters,
                'headers'     => $this->header,
            ]);
            return $this->xmlToArray(((string)($response->getBody())));
        } catch (RequestException $e) {
            dd(Psr7\str($e->getResponse()));
//            if ($e->hasResponse()) {
//                //
//            }
        }
    }

    public function driver(string $provider, $keys = [])
    {
        if (strpos($provider, ':')) {
            $arr = explode(':', $provider);
            $provider = $arr[0];
            $this->setLocal($arr[1]);
        }
        $this->setProvider($provider);
        $this->setKey($keys);
        return $this;
    }

    /**
     * @param mixed $clientVersion
     */
    public function setClientVersion($clientVersion): void
    {
        $this->clientVersion = $clientVersion;
    }

    /**
     * @param string $provider
     */
    public function setProvider(string $provider): void
    {
        $this->provider = $provider;
    }

    /**
     * @param mixed $local
     */
    public function setLocal($local): void
    {
        $this->local = $local;
    }

    /**
     * @param mixed $appName
     */
    public function setAppName($appName): void
    {
        $this->appName = $appName;
    }

    /**
     * @param mixed $awsAccessKeyId
     */
    public function setAwsAccessKeyId($awsAccessKeyId): void
    {
        $this->awsAccessKeyId = $awsAccessKeyId;
    }

    /**
     * @param mixed $awsecretAccessKey
     */
    public function setAwsecretAccessKey($awsecretAccessKey): void
    {
        $this->awsecretAccessKey = $awsecretAccessKey;
    }

    /**
     * @param mixed $mwsAuthToken
     */
    public function setMwsAuthToken($mwsAuthToken): void
    {
        $this->mwsAuthToken = $mwsAuthToken;
    }

    /**
     * @param mixed $sellerId
     */
    public function setSellerId($sellerId): void
    {
        $this->sellerId = $sellerId;
    }

    /**
     * @param mixed $merchant
     */
    public function setMerchant($merchant): void
    {
        $this->merchant = $merchant;
    }

    public function setKey(array $keys = [])
    {
        //TODO 获取当前登录用户储存的key
        $keys = array_merge(config('amazon.faker_user_keys'), $keys);
        $this->config = $keys;
        $this->setAppName($keys['app_name']);
        $this->setAwsAccessKeyId($keys['aws_access_key_id']);
        $this->setAwsecretAccessKey($keys['aws_secret_access_key']);
        $this->setSellerId($keys['seller_id']);
        $this->setMwsAuthToken($keys['auth_token']);
        $this->setLocal($keys['service_locale']);
        return $this;
    }

    private function getServiceUrl()
    {
        return config('amazon.services_url')[$this->local];
    }

    private function getPath(string $module, string $version): string
    {
        return $this->getServiceUrl() . '/' . $module . '/' . $version;
    }

    public function __call($name, $args)
    {
        $module = $this->collection->getModule($name);

        $moduleName = 'Mws\\Apis\\' . $module;
        $query = (new $moduleName($this->config))->$name($args[0]);
        $query = $this->preRequest($name, $query);

        $requestUrl = $this->getPath($module,$this->clientVersion);

        $signRequest = Signature::sign($query, $requestUrl);
        return $this->httpRequest($signRequest,$requestUrl);
    }
}