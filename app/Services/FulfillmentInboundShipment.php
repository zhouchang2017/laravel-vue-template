<?php
/**
 * Created by PhpStorm.
 * User: zhouchang
 * Date: 2018/5/14
 * Time: 下午9:36
 */

namespace App\Services;

use App\Services\DataType\CreateInboundShipmentPlanRequest;
use App\Services\Facades\FBAInboundServiceMWS;

class FulfillmentInboundShipment extends MWS implements FBAInboundServiceMWS
{

    public function __construct()
    {
        parent::__construct();
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


    public function createInboundShipmentPlan(CreateInboundShipmentPlanRequest $request)
    {
        $request->setSellerId(config('seller_id'));
        $parameters = $request->toQueryParameterArray();
        $parameters['Action'] = 'CreateInboundShipmentPlan';
        $httpResponse = $this->_invoke($parameters);

        require_once (dirname(__FILE__) . '/Model/CreateInboundShipmentPlanResponse.php');
        $response = FBAInboundServiceMWS_Model_CreateInboundShipmentPlanResponse::fromXML($httpResponse['ResponseBody']);
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


    public function getServiceStatus($request)
    {

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