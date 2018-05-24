<?php

return [
    'faker_user_keys'=>[
        'shop1'=>[
            'app_name'=>'test amazon mws by laravel',
            'seller_id' =>env('AMAZON_AWS_SELLER_ID',''),
            'auth_token'=>env('AMAZON_AWS_AUTH_TOKEN'),
            'service_locale'=>env('AMAZON_AWS_SERVICE_LOCALE','us'),
            'user_agent'=>'FBAInventoryServiceMWS PHP5 Library',
        ]
    ],
    'app_name'=>env('AMAZON_AWS_APP_NAME',env('APP_NAME')),
    /**
     * Your access key.
     */
    'aws_access_key_id' => env('AMAZON_AWS_ACCESS_KEY_ID', ''),
    /**
     * Your secret key.
     */
    'aws_secret_access_key' => env('AMAZON_AWS_SECRET_ACCESS_KEY', ''),
    /**
     * Your seller id.
     */
    'seller_id' =>env('AMAZON_AWS_SELLER_ID',''),

    'merchant' =>env('AMAZON_AWS_MERCHANT'),

    'auth_token'=>env('AMAZON_AWS_AUTH_TOKEN'),

    'service_locale'=>env('AMAZON_AWS_SERVICE_LOCALE','us'),

    'services_url'=>[
        // 北美
        'ca'=>'https://mws.amazonservices.ca',
        'us'=>'https://mws.amazonservices.com',
        // 欧洲
        'de'=>'https://mws-eu.amazonservices.com',
        'es'=>'https://mws-eu.amazonservices.com',
        'fr'=>'https://mws-eu.amazonservices.com',
        'in'=>'https://mws.amazonservices.in',
        'it'=>'https://mws-eu.amazonservices.com',
        'uk'=>'https://mws-eu.amazonservices.com',
        // 远东
        'js'=>'https://mws.amazonservices.jp',
        // 中国
        'cn'=>'https://mws.amazonservices.com.cn'
    ],
    'marketPlaceId'=>[
        // 北美
        'ca'=>'A2EUQ1WTGCTBG2',
        'us'=>'ATVPDKIKX0DER',
        // 欧洲
        'de'=>'A1PA6795UKMFR9',
        'es'=>'A1RKKUPIHCS9HS',
        'fr'=>'A13V1IB3VIYZZH',
        'in'=>'A21TJRUUN4KGV',
        'it'=>'APJ6JRA9NG5V4',
        'uk'=>'A1F83G8C2ARO7P',
        // 远东
        'js'=>'A1VC38T7YXB528',
        // 中国
        'cn'=>'AAHKV2X7AFYLW'
    ],
    'service_version'=>env('SERVICE_VERSION','2010-10-01'),

    'user_agent'=>'FBAInventoryServiceMWS PHP5 Library',

    'mws' => [
        'enumerations' => [
            'feedStatus' => [
                '_AWAITING_ASYNCHRONOUS_REPLY_' => 'The request is being processed, but is waiting for external information before it can complete.',
                '_CANCELLED_'                   => 'The request has been aborted due to a fatal error.',
                '_DONE_'                        => 'The request has been processed. You can call the GetFeedSubmissionResult operation to receive a processing report that describes which records in the feed were successful and which records generated errors.',
                '_IN_PROGRESS_'                 => 'The request is being processed.',
                '_IN_SAFETY_NET_'               => 'The request is being processed, but the system has determined that there is a potential error with the feed (for example, the request will remove all inventory from a seller\'s account.) An Amazon seller support associate will contact the seller to confirm whether the feed should be processed.',
                '_SUBMITTED_'                   => 'The request has been received, but has not yet started processing.',
                '_UNCONFIRMED_'                 => 'The request is pending.',
            ],
        ],
        'version'      => [
            'Feeds'                       => '2009-01-01',
            'Finances'                    => '2015-05-01',
            'FulfillmentInboundShipment'  => '2010-10-01',
            'FulfillmentInventory'        => '2010-10-01',
            'FulfillmentOutboundShipment' => '2010-10-01',
            'MerchantFulfillment'         => '2015-06-01',
            'Orders'                      => '2013-09-01',
            'Products'                    => '2011-10-01',
            'Recommendations'             => '2013-04-01',
            'Reports'                     => '2009-01-01',
            'Sellers'                     => '2011-07-01',
            'Subscriptions'               => '2013-07-01',
            //'CustomerInformation'         => '2014-03-01',
            //'CartInformation'             => '2014-03-01',
        ],
        'actions'      => [
            'Feeds'                       => [
                'SubmitFeed',
                'GetFeedSubmissionList',
                'GetFeedSubmissionListByNextToken',
                'GetFeedSubmissionCount',
                'CancelFeedSubmissions',
                'GetFeedSubmissionResult',
            ],
            'Finances'                    => [
                'ListFinancialEventGroups',
                'ListFinancialEventGroupsByNextToken',
                'ListFinancialEvents',
                'ListFinancialEventsByNextToken',
                'GetServiceStatus',
            ],
            'FulfillmentInboundShipment'  => [
                'GetInboundGuidanceForSKU',
                'GetInboundGuidanceForSKU',
                'CreateInboundShipmentPlan',
                'CreateInboundShipment',
                'UpdateInboundShipment',
                'GetPreorderInfo',
                'ConfirmPreorder',
                'GetPrepInstructionsForSKU',
                'GetPrepInstructionsForASIN',
                'PutTransportContent',
                'EstimateTransportRequest',
                'GetTransportContent',
                'ConfirmTransportRequest',
                'VoidTransportRequest',
                'GetPackageLabels',
                'GetUniquePackageLabels',
                'GetPalletLabels',
                'GetBillOfLading',
                'ListInboundShipments',
                'ListInboundShipmentsByNextToken',
                'ListInboundShipmentItems',
                'ListInboundShipmentItemsByNextToken',
                'GetServiceStatus',
            ],
            'FulfillmentInventory'        => [
                'ListInventorySupply',
                'ListInventorySupplyByNextToken',
                'GetServiceStatus',

            ],
            'FulfillmentOutboundShipment' => [
                'GetFulfillmentPreview',
                'CreateFulfillmentOrder',
                'UpdateFulfillmentOrder',
                'GetFulfillmentOrder',
                'ListAllFulfillmentOrders',
                'ListAllFulfillmentOrdersByNextToken',
                'GetPackageTrackingDetails',
                'CancelFulfillmentOrder',
                'ListReturnReasonCodes',
                'CreateFulfillmentReturn',
                'GetServiceStatus',
            ],
            'Merchant'                    => [
                'GetEligibleShippingServices',
                'CreateShipment',
                'GetShipment',
                'CancelShipment',
                'GetServiceStatus',
            ],
            'Orders'                      => [
                'ListOrders',
                'ListOrdersByNextToken',
                'GetOrder',
                'ListOrderItems',
                'ListOrderItemsByNextToken',
                'GetServiceStatus',
            ],
            'Products'                    => [
                'ListMatchingProducts',
                'GetMatchingProduct',
                'GetMatchingProductForId',
                'GetCompetitivePricingForSKU',
                'GetCompetitivePricingForASIN',
                'GetLowestOfferListingsForSKU',
                'GetLowestOfferListingsForASIN',
                'GetMyPriceForSKU',
                'GetMyPriceForASIN',
                'GetProductCategoriesForSKU',
                'GetProductCategoriesForASIN',
                'GetServiceStatus',
            ],
            'Recommendations'             => [
                'GetLastUpdatedTimeForRecommendations',
                'ListRecommendations',
                'ListRecommendationsByNextToken',
                'GetServiceStatus',
            ],
            'Reports'                     => [
                'RequestReport',
                'GetReportRequestList',
                'GetReportRequestListByNextToken',
                'GetReportRequestCount',
                'CancelReportRequests',
                'GetReportList',
                'GetReportListByNextToken',
                'GetReportCount',
                'GetReport',
                'ManageReportSchedule',
                'GetReportScheduleList',
                'GetReportScheduleListByNextToken',
                'GetReportScheduleCount',
                'UpdateReportAcknowledgements',

            ],
            'Sellers'=>[
                'ListMarketplaceParticipations',
                'ListMarketplaceParticipationsByNextToken'
            ],
            'Subscriptions' => [
                'RegisterDestination',
                'DeregisterDestination',
                'ListRegisteredDestinations',
                'SendTestNotificationToDestination',
                'CreateSubscription',
                'GetSubscription',
                'DeleteSubscription',
                'ListSubscriptions',
                'UpdateSubscription',
            ],
        ],
    ]
];