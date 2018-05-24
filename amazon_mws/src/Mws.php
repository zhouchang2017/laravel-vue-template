<?php

namespace Mws;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Mws\Traits\UserAgentHeaderTrait;

/**
 * Class Mws
 * @package Mws
 */
class Mws extends Client
{
    use UserAgentHeaderTrait;
    /**
     * 客户端版本
     */
    const CLIENT_VERSION = 'V0.01';
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * 商店设置信息以及authToken
     * @var
     */
    private $storeKeys;

    /**
     * 请求头
     * @var
     */
    private $header;


    /**
     * Mws constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
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
     * 设置请求头
     */
    public function setHeader()
    {
        $this->header['Content-Type'] = "application/x-www-form-urlencoded; charset=utf-8"; // We need to make sure to set utf-8 encoding here
        $this->header['Expect'] = null; // Don't expect 100 Continue
        $this->header['UserAgent'] = $this->getUserAgentHeader($this->storeKeys['app_name'], 'dev-v0.01');
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

    /**
     * @param array $params
     * @param $requestUrl
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function httpRequest(array $params, $requestUrl)
    {
        try {
            $this->setHeader();
            $response = $this->request('POST', $requestUrl, [
                'form_params' => $params,
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


    /**
     * 启动MWS服务，设置店铺信息
     * @param string|null $storeName
     * @param array $keys
     * @return $this
     * @throws Exception
     */
    public function store(string $storeName = null, $keys = [])
    {
        if ($storeName){
            $storeKeys = config('amazon.faker_user_keys.'.$storeName,[]);
            if(count($keys)>0){
                $storeKeys = array_merge($storeKeys,$keys);
            }
            if(!key_exists('seller_id',$storeKeys))throw new Exception('seller_id不存在');
            if(!key_exists('auth_token',$storeKeys))throw new Exception('auth_token不存在');
            if(!key_exists('service_locale',$storeKeys))throw new Exception('service_locale不存在');
            if(!key_exists('app_name',$storeKeys)){
                $storeKeys['app_name'] = config('amazon.app_name');
            }
            if(!key_exists('user_agent',$storeKeys)){
                $storeKeys['user_agent'] = config('amazon.user_agent');
            }

            $this->storeKeys = $storeKeys;
            return $this;
        }
        throw new Exception('缺少必要shopName参数');
    }


    /**
     * @param $name
     * @param $args
     * @return \GuzzleHttp\Promise\PromiseInterface|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __call($name, $args)
    {
        $module = $this->collection->getModule($name);
        $moduleName = 'Mws\\Apis\\' . $module;
        $apiInstance = (new $moduleName($this->storeKeys))->$name($args[0])->setAction($name)->setModuleName($module);
        try {
            $signRequest = Signature::sign($apiInstance->params, $apiInstance->getRequestUri());
            return $this->httpRequest($signRequest,$apiInstance->getRequestUri());
        } catch (Exception $e) {
            //
        }
    }
}