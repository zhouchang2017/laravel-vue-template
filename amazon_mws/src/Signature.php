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
    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $awsAccessKeyId;
    /**
     * @var
     */
    private $awsSecretAccessKey;


    /**
     * Signature constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->setAwsAccessKeyId(config('amazon.aws_access_key_id',null));
        $this->setAwsSecretAccessKey(config('amazon.aws_secret_access_key',null));
    }


    /**
     * @param string $awsAccessKeyId
     * @throws Exception
     */
    public function setAwsAccessKeyId(string $awsAccessKeyId): void
    {
        if(!$awsAccessKeyId){
            throw new Exception('确保在env文件中包含 AMAZON_AWS_ACCESS_KEY_ID 的有效值');
        }
        $this->awsAccessKeyId = $awsAccessKeyId;
    }


    /**
     * @param string $awsSecretAccessKey
     * @throws Exception
     */
    public function setAwsSecretAccessKey(string $awsSecretAccessKey): void
    {
        if(!$awsSecretAccessKey){
            throw new Exception('确保在env文件中包含 AMAZON_AWS_SECRET_ACCESS_KEY 的有效值');
        }
        $this->awsSecretAccessKey = $awsSecretAccessKey;
    }


    /**
     * @return string
     */
    private function getSignatureVersion(){
        return '2';
    }

    /**
     * @return string
     */
    private function getSignatureMethod()
    {
        return 'HmacSHA256';
    }

    /**
     * @param array $params
     * @param $serviceUrl
     * @return array
     */
    public function signer(array $params, $serviceUrl)
    {
        $params['AWSAccessKeyId'] = $this->awsAccessKeyId;
        $params['Timestamp'] = Carbon::now()->toIso8601String();
        $params['SignatureVersion'] = $this->getSignatureVersion();
        $params['SignatureMethod'] = $this->getSignatureMethod();
        $params['Signature'] = $this->signParameters($params, $this->awsSecretAccessKey,$serviceUrl);
        return $params;
    }


    /**
     * @param array $params
     * @param $serviceUrl
     * @return mixed
     * @throws Exception
     */
    public static function sign(array $params, $serviceUrl)
    {
        $signature = new static;
        return $signature->signer($params,$serviceUrl);
    }
}
