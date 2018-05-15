<?php

namespace App\Http\Controllers;

use App\Services\DataType\CreateInboundShipmentPlanRequest;
use App\Services\DataType\GetServiceStatusRequest;
use App\Services\FulfillmentInboundShipment;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $fba;

    /**
     * TestController constructor.
     * @param $fba
     */
    public function __construct(FulfillmentInboundShipment $fba)
    {
        $this->fba = $fba;
    }

    public function index(GetServiceStatusRequest $request)
    {
        $response = $this->fba->getServiceStatus($request);

    }
}
