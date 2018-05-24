<?php

namespace Mws\Apis;


class Feeds extends Api
{
    /*
     * 上传数据类型
     * _POST_PRODUCT_DATA_                                  商品上传数据
     * _POST_PRODUCT_RELATIONSHIP_DATA_                     商品关联上传数据
     * _POST_ITEM_DATA_                                     商品上传数据
     * _POST_OFFER_ONLY_DATA_                               仅含价格的上传数据
     * _POST_WEBSTORE_ITEM_DATA_ WebStore                   商品上传数据
     *
     * _POST_PRODUCT_IMAGE_DATA_                            图片上传数据
     *
     * _POST_PRODUCT_PRICING_DATA_                          价格上传数据
     *
     * _POST_INVENTORY_AVAILABILITY_DATA_                   库存上传数据
     *
     * _POST_ORDER_FULFILLMENT_DATA_                        发货确认
     *
     * _POST_FULFILLMENT_ORDER_CANCELLATION_REQUEST_DATA_   配送订单取消请求
     *
     * _POST_PRODUCT_OVERRIDES_DATA_                        商品配送调整上传数据
     * _POST_SHIPPING_OVERRIDE_DATA_                        配送调整上传数据
     *
     **/

    const VERSION = '2009-01-01';

    public function __construct(array $storeKeys)
    {
        parent::__construct($storeKeys);
        $this->setParamsVersion(self::VERSION)->setParamsMarketplaceId();
    }

    public function submitFeed()
    {

    }
}