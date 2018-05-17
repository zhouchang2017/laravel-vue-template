<?php
/**
 * Created by PhpStorm.
 * User: zhouchang
 * Date: 2018/5/14
 * Time: 下午9:36
 */

namespace App\Services;

use App\Services\DataType\CreateInboundShipmentPlanResponse;
use App\Services\Facades\FBAInboundServiceMWS;
use Illuminate\Http\Request;

class FulfillmentInboundShipment extends MWS implements FBAInboundServiceMWS
{
    const SERVICE_VERSION = '2010-10-01';

    public function __construct()
    {
        parent::__construct(self::SERVICE_VERSION);
    }

    public function setServiceUrl()
    {
        $this->serviceUrl = $this->getServiceLocaleUrl() . '/FulfillmentInboundShipment/'.self::SERVICE_VERSION;
    }

    public function getServiceUrl()
    {
        return $this->serviceUrl;
    }

    public function confirmPreorder($request)
    {
        //
    }


    public function confirmTransportRequest($request)
    {

    }


    public function createInboundShipment($request)
    {

    }


    public function createInboundShipmentPlan(Request $request)
    {
        $parameters = $request->toQueryParameterArray();
        $parameters['Action'] = 'CreateInboundShipmentPlan';

        $httpResponse = $this->invoke($parameters);

        $response = CreateInboundShipmentPlanResponse::fromXML($httpResponse['ResponseBody']);
        $response->setResponseHeaderMetadata($httpResponse['ResponseHeaderMetadata']);
        return $response;
    }


    public function estimateTransportRequest($request)
    {

    }


    public function getBillOfLading($request)
    {

    }


    public function getInboundGuidanceForASIN($request)
    {

    }


    public function getInboundGuidanceForSKU($request)
    {

    }


    public function getPackageLabels($request)
    {

    }


    public function getPalletLabels($request)
    {

    }


    public function getPreorderInfo($request)
    {

    }


    public function getPrepInstructionsForASIN($request)
    {

    }

    public function getPrepInstructionsForSKU($request)
    {

    }




    public function getServiceStatus(Request $request)
    {
        $parameters['Action'] = 'GetServiceStatus';
        $httpResponse = $this->invoke($parameters);
        return $this->xmlToArray($httpResponse);
    }

    public function getTransportContent($request)
    {

    }

    public function getUniquePackageLabels($request)
    {

    }

    public function listInboundShipmentItems($request)
    {

    }

    public function listInboundShipmentItemsByNextToken($request)
    {

    }

    public function listInboundShipments($request)
    {

    }

    public function listInboundShipmentsByNextToken($request)
    {

    }


    public function putTransportContent($request)
    {

    }


    public function updateInboundShipment($request)
    {

    }

    public function voidTransportRequest($request)
    {

    }
}