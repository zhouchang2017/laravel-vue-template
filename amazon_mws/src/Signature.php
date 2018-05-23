<?php
namespace Mws;
use Exception;
use Carbon\Carbon;
use Mws\Traits\SignTrait;
/**
 *
 */
class Signature
{
    use SignTrait;
    private $config;
    protected $defaults;

    private $provider = 'amazon';

    public function __construct(array $keys = [])
    {
        $this->config = array_merge(config('amazon.faker_user_keys'),$keys);
    }

    private function getMarketplaceId(){
        $local = array_get($this->config,'local');
        return config('amazon.marketPlaceId')[$local];
    }

    private function getSignatureVersion(){
        return '2';
    }

    private function getSignatureMethod()
    {
        return 'HmacSHA256';
    }
    public function signer(array $params,$serviceUrl)
    {
        $params['SellerId'] = array_get($this->config,'seller_id');
//        $params['Merchant'] = config('amazon.merchant');
        $params['MWSAuthToken'] = array_get($this->config,'auth_token');
        $params['AWSAccessKeyId'] = array_get($this->config,'aws_access_key_id');
        $params['Timestamp'] = Carbon::now()->toIso8601String();
        $params['SignatureVersion'] = $this->getSignatureVersion();
        $params['SignatureMethod'] = $this->getSignatureMethod();
        $params['Signature'] = $this->signParameters($params, array_get($this->config,'aws_secret_access_key'),$serviceUrl);
        return $params;
    }



    public static function sign(array $params,$serviceUrl)
    {
        $signature = new static;
        return $signature->signer($params,$serviceUrl);
    }
}
