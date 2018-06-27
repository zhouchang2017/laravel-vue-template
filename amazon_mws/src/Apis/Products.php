<?php

namespace Mws\Apis;


use Illuminate\Http\Request;

class Products extends Api
{
    const VERSION = '2011-10-01';

    public function __construct(array $storeKeys)
    {
        parent::__construct($storeKeys);
        $this->setParamsVersion(self::VERSION)->setParamsMarketplaceId();
    }

    public function listMatchingProducts(Request $request)
    {
        $this->params =  array_merge($this->params, [
            'Query' => $request->input('query', '')
        ]);
        return $this;
    }
}