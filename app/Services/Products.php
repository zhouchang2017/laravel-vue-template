<?php
/**
 * Created by PhpStorm.
 * User: zhouchang
 * Date: 2018/5/14
 * Time: 下午9:36
 */

namespace App\Services;

use App\Services\DataType\CreateInboundShipmentPlanRequest;
use App\Services\DataType\CreateInboundShipmentPlanResponse;
use App\Services\DataType\GetServiceStatusRequest;
use App\Services\DataType\GetServiceStatusResponse;
use App\Services\Facades\FBAInboundServiceMWS;
use Illuminate\Http\Request;

class Products extends MWS
{
    const SERVICE_VERSION = '2011-10-01';
    public $marketplaceId = 'ATVPDKIKX0DER';

    public function __construct()
    {
        parent::__construct(self::SERVICE_VERSION,['MarketplaceId'=>$this->marketplaceId]);
    }

    public function setServiceUrl()
    {
        $this->serviceUrl = $this->getServiceLocaleUrl() . '/Products/'.self::SERVICE_VERSION;
    }

    public function getServiceUrl()
    {
        return $this->serviceUrl;
    }

    public function ListMatchingProducts(Request $request)
    {
        $parameters['Query'] = $request->input('query');
        $parameters['Action'] = 'ListMatchingProducts';

        $httpResponse = $this->invoke($parameters);
        return $this->xmlToArray($httpResponse);
    }

    public function GetMatchingProduct(Request $request)
    {
        $asins = is_array($request->input('asin')) ? $request->input('asin') : [$request->input('asin')];
        // TODO 需要抽离，支持多参数
        $asinList = collect($asins)->reduce(function ($carry, $item) {
            $carry['ASINList.ASIN.'.(count($carry)+1)] = $item;
            return $carry;
        }, []);
        $parameters['MarketplaceId'] = $this->marketplaceId;
        $parameters['Action'] = 'GetMatchingProduct';
        $parameters = array_merge($asinList,$parameters);
        $httpResponse = $this->invoke($parameters);
        return $this->xmlToArray($httpResponse);
    }


}