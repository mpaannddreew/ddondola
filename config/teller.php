<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 18/04/2019
 * Time: 15:10
 */

return [
    'default' => env('PAYMENT_METHOD', 'mtn'),
    'methods' => [
        'mtn' => [
            'common' => [
                'callbackHost' => env('MOMO_CALLBACK_HOST', 'http://localhost:8000'),
                'callbackUrl' => env('MOMO_CALLBACK_URL', 'http://localhost:8000/callback'),
                'environment' => env('MOMO_TARGET_ENVIRONMENT', 'sandbox'),
                'accountHolderIdType' => env('MOMO_PARTY_ID_TYPE', 'msisdn'),
                'xReferenceId' => env('MOMO_API_USER_ID', ''),
                'apiKey' => env('MOMO_API_USER_KEY', ''),
                'accessToken' => env('MOMO_ACCESS_TOKEN', ''),
            ],
            'products' => [
                'collection' => [
                    'subscriptionKey' => env('MOMO_COLLECTION_SUBSCRIPTION_KEY', '906b295eb76e4649864dbb4deb69e724'),
                    'preApproval' => env('MOMO_COLLECTION_PREAPPROVAL', false),
                ],
                'disbursement' => [
                    'subscriptionKey' => env('MOMO_DISBURSEMENT_SUBSCRIPTION_KEY', '915157742b0f4e72b79e9a2508cf6c93')
                ],
                'remittance' => [
                    'subscriptionKey' => env('MOMO_COLLECTION_SUBSCRIPTION_KEY', 'a00e6eaf2c65427090f732cf2d720159'),
                ],
            ]
        ]
    ]
];