<?php

return [
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
        'us'=>'https://mws.amazonservices.com',
        'eu'=>'https://mws-eu.amazonservices.com',
        'jp'=>'https://mws.amazonservices.jp',
        'cn'=>'https://mws.amazonservices.com.cn'
    ],
    'service_version'=>env('SERVICE_VERSION','2010-10-01'),

    'user_agent'=>'FBAInventoryServiceMWS PHP5 Library'
];