<?php
namespace App\Services\Facades;

/**
 * Interface FBAInboundServiceMWS
 * @package App\Services\Facades
 */
interface  FBAInboundServiceMWS
{

    public function confirmPreorder($request);

    public function confirmTransportRequest($request);

    public function createInboundShipment($request);

    public function createInboundShipmentPlan($request);

    public function estimateTransportRequest($request);

    public function getBillOfLading($request);

    public function getInboundGuidanceForASIN($request);

    public function getInboundGuidanceForSKU($request);

    public function getPackageLabels($request);

    public function getPalletLabels($request);

    public function getPreorderInfo($request);

    public function getPrepInstructionsForASIN($request);

    public function getPrepInstructionsForSKU($request);

    public function getServiceStatus(Request $request);

    public function getTransportContent($request);

    public function getUniquePackageLabels($request);

    public function listInboundShipmentItems($request);

    public function listInboundShipmentItemsByNextToken($request);

    public function listInboundShipments($request);

    public function listInboundShipmentsByNextToken($request);

    public function putTransportContent($request);

    public function updateInboundShipment($request);

    public function voidTransportRequest($request);

}