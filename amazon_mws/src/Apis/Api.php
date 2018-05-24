<?php
namespace Mws\Apis;

use Mws\Mws;
use Mws\Collection;

abstract class Api
{
    public $params = [];
    protected $storeKeys;
    protected $moduleName;


    public function setModuleName($moduleName)
    {
        $this->moduleName = studly_case($moduleName);
        return $this;
    }

    public function __construct(array $storeKeys)
    {
        $this->storeKeys = $storeKeys;
        $this->setParamsSellerId($storeKeys['seller_id'])->setParamsAuthToken($storeKeys['auth_token']);
    }

    public function setParamsSellerId($sellerId)
    {
        $this->params['SellerId'] = $sellerId;
        return $this;
    }

    public function setParamsAuthToken($authToken)
    {
        $this->params['MWSAuthToken'] = $authToken;
    }

    public function setAction(string $name)
    {
        $this->params = array_merge($this->params,[
            'Action'=>studly_case($name)
        ]);
        return $this;
    }


    public function setParamsVersion(string $version)
    {
        $this->params['Version'] = $version;
        return $this;
    }

    public function getVersion()
    {
        return $this->params['Version'];
    }

    public function getServiceUrl()
    {
        return config('amazon.services_url')[$this->getLocale()];
    }

    public function getRequestUri(): string
    {
        return $this->getServiceUrl() . '/' . $this->moduleName . '/' . $this->getVersion();
    }


    public function getLocale(){
        return array_get($this->storeKeys, 'service_locale');
    }

    private function getMarketplaceId()
    {
        return config('amazon.marketPlaceId')[$this->getLocale()];
    }

    public function setParamsMarketplaceId()
    {
        $this->params['MarketplaceId'] = $this->getMarketplaceId();
        return $this;
    }

	protected function cleanQuery(array $query, array $allowed)
	{
		$query = collect($query)->transform(function($item) {
			if ($item instanceOf \Carbon\Carbon) {
				$item = $item->toIso8601String();
			}
			return $item;
		})->flip()->transform(function($item) {
			return studly_case($item);			
		})->filter(function($item) use ($allowed) {
			return in_array($item, $allowed);
		})->flip()->toArray();

		return $query;
	}
}