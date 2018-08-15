<?php

namespace App\Http\Controllers;

use App\Modules\ProductProvider\Models\ProductProvider;
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
    public function __construct()
    {
//        $this->fba = $fba;
//        $this->products = $products;
    }

    public function test()
    {

    }

    public function index(Request $request)
    {
//         $address = $request->input('address');
//         $addr = new Address($address);
//         dump($addr->toArray());
//         die();
//         return $this->fba->getServiceStatus($request);
        $feed = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<AmazonEnvelope xsi:noNamespaceSchemaLocation="amzn-envelope.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <Header>
        <DocumentVersion>1.01</DocumentVersion>
        <MerchantIdentifier>M_MWSTEST_49045593</MerchantIdentifier>
    </Header>
    <MessageType>OrderFulfillment</MessageType>
    <Message>
        <MessageID>1</MessageID>
        <OperationType>Update</OperationType>
        <OrderFulfillment>
            <AmazonOrderID>002-3275191-2204215</AmazonOrderID>
            <FulfillmentDate>2009-07-22T23:59:59-07:00</FulfillmentDate>
            <FulfillmentData>
                <CarrierName>Contact Us for Details</CarrierName>
                <ShippingMethod>Standard</ShippingMethod>
            </FulfillmentData>
            <Item>
                <AmazonOrderItemCode>42197908407194</AmazonOrderItemCode>
                <Quantity>1</Quantity>
            </Item>
        </OrderFulfillment>
    </Message>
</AmazonEnvelope>
EOD;
        $feedHandle = @fopen('php://memory', 'rw+');
        fwrite($feedHandle, $feed);
        rewind($feedHandle);
//        $md5 = base64_encode(md5(stream_get_contents($feedHandle), true));
        dd($feedHandle);
    }

    public function products(Request $request)
    {
        return $this->products->ListMatchingProducts($request);
    }

    public function byAsins(Request $request)
    {
        return $this->products->GetMatchingProduct($request);
    }

    public function xsd(Request $request)
    {
        $filePath = base_path('amazon_mws/src/Xsd/') . 'Product.xsd';
        $xsdClass = new Xsd2Php($filePath);
        $xsdClass->saveClasses(base_path('amazon_mws/src/XsdClass'));
//        $response = Mws::store('shop1')->getReport($request);
//        dd($response);
        //$this->download("amzn-envelope.xsd");
    }

    public function download($schema)
    {
        foreach ([ "https://images-na.ssl-images-amazon.com/images/G/01/rainier/help/xsd/release_4_1/", "https://images-na.ssl-images-amazon.com/images/G/01/rainier/help/xsd/release_1_9/" ] as $ns) {
            $source = @simplexml_load_file($ns . $schema);

            if ($source) {
                $source->registerXPathNamespace("xsd", "http://www.w3.org/2001/XMLSchema");

                foreach ($source->xpath("//xsd:include") as $include)
                    $this->download($include->attributes()->schemaLocation);

                file_put_contents(base_path('amazon_mws/src/Xsd/') . $schema, $source->asXML());
                return true;
            }
        }

        return false;
    }
}
