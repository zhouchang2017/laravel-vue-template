<?php

namespace Mws\Apis;


use Illuminate\Http\Request;

class Products extends Api
{
    private $marketPlaceId;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->marketPlaceId = $this->getMarketplaceId();
    }

    private function getMarketplaceId()
    {
        $local = array_get($this->config, 'service_locale');
        return config('amazon.marketPlaceId')[$local];
    }

    public function listMatchingProducts(Request $request)
    {
        return [
            'MarketplaceId' => $this->marketPlaceId,
            'Query'         => $request->input('query', ''),
        ];
    }
}