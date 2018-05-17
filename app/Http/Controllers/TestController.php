<?php

namespace App\Http\Controllers;

use App\Services\DataType\Address;
use App\Services\DataType\CreateInboundShipmentPlanRequest;
use App\Services\DataType\GetServiceStatusRequest;
use App\Services\FulfillmentInboundShipment;
use App\Services\Products;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $fba;
    protected $products;


    /**
     * TestController constructor.
     * @param FulfillmentInboundShipment $fba
     * @param Products $products
     */
    public function __construct(FulfillmentInboundShipment $fba, Products $products)
    {
        $this->fba = $fba;
        $this->products = $products;
    }

    public function index(Request $request)
    {
         $address = $request->input('address');
         $addr = new Address($address);
         dump($addr->toArray());
         die();
         return $this->fba->getServiceStatus($request);
    }

    public function products(Request $request)
    {
       return $this->products->ListMatchingProducts($request);
    }

    public function byAsins(Request $request)
    {
        return $this->products->GetMatchingProduct($request);
    }
}
